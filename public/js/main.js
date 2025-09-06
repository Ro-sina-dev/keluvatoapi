// Minimal, non-intrusive enhancements for orders UI and header behavior
// 1) Normalize order statuses for filtering consistency
// 2) Improve product item widths on small screens
// 3) Fallback header auto-hide if #mainHeader is missing

(function () {
  try {
    // Run as early as possible (script tag is before inline init code)

    // 1) Normalize statuses on order cards so existing filter buttons work consistently
    var cards = document.querySelectorAll('.order-card[data-status]');
    if (cards && cards.length) {
      var statusMap = {
        shipped: 'delivered',
        completed: 'delivered',
        canceled: 'cancelled',
      };
      cards.forEach(function (c) {
        var s = (c.getAttribute('data-status') || '').toLowerCase().trim();
        if (statusMap[s]) {
          c.setAttribute('data-status', statusMap[s]);
          // Also harmonize the badge color for known synonyms
          var badge = c.querySelector('.order-status');
          if (badge) {
            if (statusMap[s] === 'delivered') {
              badge.style.background = '#4caf50';
              badge.style.color = '#fff';
            } else if (statusMap[s] === 'cancelled') {
              badge.style.background = '#f44336';
              badge.style.color = '#fff';
            }
          }
        }
      });
    }

    // 2) Responsive width fix for product items where inline styles enforce 50%
    function applyOrderResponsive() {
      try {
        var items = document.querySelectorAll('.order-products .product-item');
        if (!items || !items.length) return;
        var isMobile = window.innerWidth <= 768;
        items.forEach(function (el) {
          if (isMobile) {
            el.style.width = '100%';
          } else {
            // keep the original intent (2 columns) unless the page CSS overrides elsewhere
            el.style.width = 'calc(50% - 10px)';
          }
        });
      } catch (_) {}
    }
    applyOrderResponsive();
    window.addEventListener('resize', applyOrderResponsive);

    // 3) Header auto-hide fallback (if template doesn’t expose #mainHeader)
    (function initHeaderAutoHideFallback() {
      var header = document.querySelector('#mainHeader') || document.querySelector('header');
      if (!header) return;
      var last = 0;
      window.addEventListener('scroll', function () {
        var y = window.pageYOffset || document.documentElement.scrollTop || 0;
        header.style.top = y > last ? '-150px' : '0';
        last = y <= 0 ? 0 : y;
      });
    })();
  } catch (e) {
    // Never break the page
    console && console.warn && console.warn('[main.js] Enhancement skipped:', e);
  }
})();

