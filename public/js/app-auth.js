(() => {
  const App = (window.App ||= {});
  // Configuration API - utilise les routes web Laravel directement (plus d'API)
  App.apiBase = window.location.origin;

  App.roleLabel = (role) => {
    switch (role) {
      case "admin": return "administrateur";
      case "pro":   return "professionnel";
      default:      return "utilisateur simple";
    }
  };

  const $links = () => document.querySelectorAll(".auth-link");

  function setLink(link, { html, href }) {
    link.innerHTML = html;
    link.href = href;
    link.style.visibility = "visible";
  }

  App.setLoggedOutUI = function () {
    $links().forEach((link) =>
      setLink(link, {
        html: `<i class="fas fa-briefcase" style="font-size:14px"></i><span>S'inscrire</span>`,
        href: "/login.html",
      })
    );
  };

  App.setLoggedInUI = function (user) {
    const label = `${user.name ?? "Mon compte"} — ${App.roleLabel(user.role)}`;
    $links().forEach((link) =>
      setLink(link, {
        html: `<i class="fas fa-user" style="font-size:14px"></i><span>${label}</span>`,
        href: "/profil.html",
      })
    );
  };

  App.authFetch = async function (url, options = {}) {
    const token = localStorage.getItem("userToken");
    const headers = {
      Accept: "application/json",
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
      ...(options.headers || {}),
    };
    if (token) headers.Authorization = `Bearer ${token}`;
    return fetch(url, { ...options, headers });
  };

  App.logout = function () {
    localStorage.removeItem("userToken");
    localStorage.removeItem("userName");
    localStorage.removeItem("userRole");
    localStorage.removeItem("authUser");
    App.setLoggedOutUI();
  };

  App.onLoginSuccess = function (data) {
    if (data?.token) localStorage.setItem("userToken", data.token);
    if (data?.user) {
      localStorage.setItem("userName", data.user.name || "");
      localStorage.setItem("userRole", data.user.role || "");
      localStorage.setItem("authUser", JSON.stringify(data.user));
      App.setLoggedInUI(data.user);
    } else {
      App.setLoggedOutUI();
    }
  };

  App.setAuthUI = function (user) {
    App.setLoggedInUI(user);
  };

  document.addEventListener("DOMContentLoaded", async () => {
    const links = $links();
    if (!links.length) return;

    const token = localStorage.getItem("userToken");
    const cachedName = localStorage.getItem("userName");
    const cachedRole = localStorage.getItem("userRole");

    // Anti-flash: affichage depuis le cache si disponible
    if (token && (cachedName || cachedRole)) {
      App.setLoggedInUI({ name: cachedName, role: cachedRole });
    } else {
      App.setLoggedOutUI();
    }

    // Vérification côté serveur
    if (!token) return;
    try {
      const res = await App.authFetch(`${App.apiBase}/me`);
      if (res.ok) {
        const data = await res.json();
        if (data?.user) {
          localStorage.setItem("userName", data.user.name || "");
          localStorage.setItem("userRole", data.user.role || "");
          localStorage.setItem("authUser", JSON.stringify(data.user));
          App.setLoggedInUI(data.user);
        } else {
          App.logout();
        }
      } else if (res.status === 401) {
        App.logout();
      }
    } catch (error) {
      console.log("Erreur de vérification auth:", error);
    }
  });

  window.handleLogout = () => App.logout();
})();
