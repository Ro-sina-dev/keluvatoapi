<header id=""
    style="
        background: #1f4e5f;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: sticky;
        top: 0;
        z-index: 100;
        transition: top 0.3s;
      ">
    <div class="container header-container"
        style="
          display: flex;
          align-items: center;
          max-width: 1200px;
          margin: 0 auto;
          padding: 0 15px;
        ">
        <!-- Logo -->
        <!--  <a href="index.html" style="display: inline-block">
                <div class="logo-wrapper" style="flex: 0 0 auto">
                    <!-- Votre logo (peut être une image ou un fond CSS) -->
        <!--  </div>-->
        <!-- </a>-->

        <a href="{{ route('home') }}" style="display: inline-block">
            <div class="logo-wrapper"
                style="
        background-image: url('{{ asset('assets/IMG.png') }}');
        background-size: contain;
        background-repeat: no-repeat;
        width: 250px;
        height: 80px;
        flex-shrink: 0;">
            </div>
        </a>

        <!-- Barre de recherche -->
        <div class="search-container"
            style="
            flex: 1 1 auto;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
          ">
            <input id="searchInput" type="text" placeholder="Rechercher des meubles, décoration..."
                style="
              width: 100%;
              padding: 10px 15px;
              border: 2px solid #f1f1f1;
              border-radius: 25px;
              font-size: 14px;
              outline: none;
              background: white;
            " />
            <button id="searchBtn"
                style="
              position: absolute;
              right: 3px;
              top: 3px;
              background: white;
              color: #4a6bff;
              border: none;
              border-radius: 50%;
              width: 34px;
              height: 34px;
              cursor: pointer;
            ">
                <i class="fas fa-search"></i>
            </button>
            <!-- Suggestions dropdown -->
            <div id="searchDropdown"
                style="display:none; position:absolute; top:44px; left:0; right:0; background:#fff; border:1px solid #eee; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.08); overflow:hidden; z-index:999;">
            </div>
        </div>


        <div class="right-menu" style="display: flex; align-items: center; gap: 10px; flex: 0 0 auto">
            <!-- Menu burger pour mobile -->
            <button class="mobile-menu-toggle"
                style="
              display: none;
              background: none;
              border: none;
              color: white;
              padding: 8px;
              cursor: pointer;
            ">
                <svg width="35" height="35" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"
                    focusable="false" class="chakra-icon css-pks0an" aria-hidden="true">
                    <path d="M2 3.188h16v1.615H2V3.188zM2 9.033h16v1.615H2V9.033zM2 14.606h16v1.615H2v-1.615z"
                        fill="#ffffff">
                    </path>
                </svg>
            </button>
        </div>

        <!-- Icônes et liens (version desktop) -->
        <div class="desktop-icons" style="flex: 0 0 auto; display: flex; align-items: center; gap: 12px">
            <div class="user-dropdown" style="position: relative">
                <button id="userToggle"
                    style="
                background: none;
                border: none;
                cursor: pointer;
                color: white;
                position: relative;
                padding: 8px;
              ">
                    <i class="fas fa-user" style="font-size: 22px; transition: all 0.2s"></i>
                    <span class="user-pulse"
                        style="
                  position: absolute;
                  top: 0;
                  right: 0;
                  width: 8px;
                  height: 8px;
                  background: #ffcc00;
                  border-radius: 50%;
                  border: 2px solid #4a6bff;
                  display: none;
                "></span>
                </button>
                <div id="dropdownUser" class="dropdown-menu"
                    style="
                display: none;
                position: absolute;
                right: 0;
                top: 100%;
                background: white;
                min-width: 220px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                z-index: 100;
                overflow: hidden;
                margin-top: 10px;
                transform-origin: top right;
                animation: fadeIn 0.15s ease-out;
              ">
                    <div style="padding: 8px 0; border-bottom: 1px solid #f5f5f5">
                        @auth
                            <a href="{{ route('profile') }}"
                                style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 14px;
                    transition: all 0.2s;
                  ">
                                <i class="fas fa-user-circle"
                                    style="
                      margin-right: 12px;
                      color: #4a6bff;
                      width: 20px;
                      text-align: center;
                    "></i>
                                <span>Mon profil</span>
                            </a>
                        @endauth
                        <a href="#"
                            style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 14px;
                    transition: all 0.2s;
                  ">
                            <i class="fas fa-heart"
                                style="
                      margin-right: 12px;
                      color: #ff4081;
                      width: 20px;
                      text-align: center;
                    "></i>
                            <span>Mes favoris</span>
                            <span
                                style="
                      margin-left: auto;

                      color: white;
                      font-size: 11px;
                      padding: 2px 6px;
                      border-radius: 10px;
                    "></span>
                        </a>
                        <a href="{{ route('orders') }}"
                            style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 14px;
                    transition: all 0.2s;
                  ">
                            <i class="fas fa-box-open"
                                style="
                      margin-right: 12px;
                      color: #4caf50;
                      width: 20px;
                      text-align: center;
                    "></i>
                            <span>Mes commandes</span>
                        </a>
                    </div>
                </div>
            </div>
            @auth
                <a class="desktop-only" href="{{ route('profile') }}" style="font-size: 14px;
                    color: white;
                    background: rgba(255, 255, 255, 0.1);
                    padding: 8px 15px;
                    border-radius: 20px;
                    text-decoration: none;
                    transition: all 0.2s;
                    display: flex;
                    align-items: center;
                    gap: 6px;">
                    <i class="fas fa-user" style="font-size: 14px"></i>
                    <span>{{ Auth::user()->name }} — {{ Auth::user()->role }}</span>

                </a>
            @else
                <a class="auth-link desktop-only" href="{{ route('login') }}"
                    style="
                    font-size: 14px;
                    color: white;
                    background: rgba(255, 255, 255, 0.1);
                    padding: 8px 15px;
                    border-radius: 20px;
                    text-decoration: none;
                    transition: all 0.2s;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    ">
                    <i class="fas fa-briefcase" style="font-size: 14px"></i>
                    <span>S'inscrire</span>
                </a>
            @endauth



            <div class="help-dropdown" style="position: relative">
                <button id="helpToggle"
                    style="
                background: none;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
                color: white;
                font-weight: 500;
                font-size: 16px;
                padding: 8px 12px;
                border-radius: 20px;
                transition: all 0.2s;
              ">
                    <i class="fas fa-question-circle" style="font-size: 20px"></i>
                    <span>Aide</span>
                </button>
                <div id="dropdownHelp" class="dropdown-menu"
                    style="
                display: none;
                position: absolute;
                right: 0;
                top: 100%;
                background: white;
                min-width: 250px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                z-index: 100;
                overflow: hidden;
                margin-top: 10px;
                transform-origin: top right;
                animation: fadeIn 0.15s ease-out;
              ">
                    <div
                        style="
                  padding: 15px;
                  background: linear-gradient(135deg, #4a6bff, #6a5acd);
                  color: white;
                ">
                        <h4
                            style="
                    margin: 0;
                    font-size: 16px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                  ">
                            <i class="fas fa-headset"></i>
                            <span>Centre d'assistance</span>
                        </h4>
                    </div>
                    <div style="padding: 8px 0">
                        <a href="{{ route('orders') }}"
                            style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 14px;
                    transition: all 0.2s;
                  ">
                            <i class="fas fa-truck"
                                style="
                      margin-right: 12px;
                      color: #4a6bff;
                      width: 20px;
                      text-align: center;
                    "></i>
                            <span>Suivre ma commande</span>
                        </a>
                        <!-- <a href="faire-retour.html" style="display: flex; align-items: center; padding: 10px 15px; color: #333; text-decoration: none; font-size: 14px; transition: all 0.2s;">
                                    <i class="fas fa-exchange-alt" style="margin-right: 12px; color: #4a6bff; width: 20px; text-align: center;"></i>
                                    <span>Faire un retour</span>
                                </a>
                                <a href="annuler-ma-commande.html" style="display: flex; align-items: center; padding: 10px 15px; color: #333; text-decoration: none; font-size: 14px; transition: all 0.2s;">
                                    <i class="fas fa-ban" style="margin-right: 12px; color: #4a6bff; width: 20px; text-align: center;"></i>
                                    <span>Annuler ma commande</span>
                                </a>-->
                        <a href="contactez-nous.html"
                            style="
                    display: flex;
                    align-items: center;
                    padding: 10px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 14px;
                    transition: all 0.2s;
                  ">
                            <i class="fas fa-phone-alt"
                                style="
                      margin-right: 12px;
                      color: #4a6bff;
                      width: 20px;
                      text-align: center;
                    "></i>
                            <span>Contactez-nous</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="country-dropdown" style="position: relative">
                <button id="countryToggle"
                    style="
                background: none;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                gap: 5px;
                color: white;
                padding: 6px 8px;
                border-radius: 20px;
              ">
                    <span class="country-flag"
                        style="
                  width: 20px;
                  height: 15px;
                  background-image: url('https://flagcdn.com/w20/fr.png');
                  background-size: cover;
                "></span>
                    <span class="country-code" style="font-size: 14px">FR</span>
                    <i class="fas fa-chevron-down" style="font-size: 10px; margin-left: 3px"></i>
                </button>

                <!-- Modal Structure -->
                <div id="dropdownCountry" class="modal"
                    style="
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                overflow: auto;
              ">
                    <div class="modal-content"
                        style="
                  background: white;
                  margin: 5% auto;
                  padding: 25px;
                  width: 500px;
                  max-height: 80vh;
                  overflow-y: auto;
                  box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2);
                  border-radius: 12px;
                ">
                        <form id="regionForm">
                            <span class="close"
                                style="
                      float: right;
                      font-size: 28px;
                      cursor: pointer;
                      margin-top: -10px;
                    ">&times;</span>

                            <h2 style="margin-top: 0; color: #333; font-size: 24px" data-i18n="regional_settings">
                                Paramètres régionaux
                            </h2>

                            <p class="wt-mb-xs-3 wt-text-body-01" style="margin-bottom: 25px"
                                data-i18n="regional_text">
                                Paramétrez votre pays, votre langue, et la devise que vous
                                utilisez.
                            </p>

                            <!-- Devise -->
                            <div style="margin-bottom: 20px">
                                <label
                                    style="
                        display: block;
                        margin-bottom: 8px;
                        font-weight: 600;
                      "
                                    data-i18n="currency_label">Devise</label>
                                <select name="currency" id="currency"
                                    style="
                        width: 100%;
                        padding: 10px;
                        border: 1px solid #ddd;
                        border-radius: 6px;
                        font-size: 16px;
                      ">
                                    <option value="EUR">Euro (€)</option>
                                    <option value="USD">Dollar US ($)</option>
                                    <option value="GBP">Livre sterling (£)</option>
                                    <option value="CAD">Dollar canadien (C$)</option>
                                    <option value="AUD">Dollar australien (A$)</option>
                                    <option value="JPY">Yen japonais (¥)</option>
                                    <option value="CHF">Franc suisse (CHF)</option>
                                </select>
                            </div>

                            <!-- Pays/Région -->
                            <div style="margin-bottom: 20px">
                                <label
                                    style="
                                        display: block;
                                        margin-bottom: 8px;
                                        font-weight: 600;
                                    "
                                    data-i18n="country_label">Pays/Région</label>
                                <select name="country" id="country"
                                    style="
                                        width: 100%;
                                        padding: 10px;
                                        border: 1px solid #ddd;
                                        border-radius: 6px;
                                        font-size: 16px;
                                    ">
                                    <option value="FR">France</option>
                                    <option value="BE">Belgique</option>
                                    <option value="CA">Canada</option>
                                    <option value="CH">Suisse</option>
                                    <option value="US">États-Unis</option>
                                    <option value="UK">Royaume-Uni</option>
                                    <option value="DE">Allemagne</option>
                                    <option value="ES">Espagne</option>
                                    <option value="IT">Italie</option>
                                    <option value="JP">Japon</option>
                                    <option value="AU">Australie</option>
                                </select>
                            </div>

                            <!-- Langue -->
                            <div style="margin-bottom: 30px">
                                <label
                                    style="
                                        display: block;
                                        margin-bottom: 8px;
                                        font-weight: 600;
                                    "
                                    data-i18n="language_label">Langue</label>
                                <select name="language" id="language"
                                    style="
                                    width: 100%;
                                    padding: 10px;
                                    border: 1px solid #ddd;
                                    border-radius: 6px;
                                    font-size: 16px;
                                ">
                                    <option value="fr-FR">Français</option>
                                    <option value="en-US">English</option>
                                    <option value="es-ES">Español</option>
                                    <option value="de-DE">Deutsch</option>
                                    <option value="it-IT">Italiano</option>
                                    <option value="pt-BR">Português</option>
                                    <option value="nl-NL">Nederlands</option>
                                    <option value="ja-JP">日本語</option>
                                </select>
                            </div>

                            <div
                                style="
                                    display: flex;
                                    justify-content: flex-end;
                                    gap: 15px;
                                    margin-top: 20px;
                                    ">
                                <button type="button" class="cancel-btn"
                                    style="
                                        padding: 10px 20px;
                                        background: #f5f5f5;
                                        border: 1px solid #ddd;
                                        border-radius: 6px;
                                        cursor: pointer;
                                        font-size: 16px;
                                    "
                                    data-i18n="cancel_button">
                                    Annuler
                                </button>
                                <button type="submit" class="save-btn"
                                    style="
                                        padding: 10px 20px;
                                        background: #007bff;
                                        color: white;
                                        border: none;
                                        border-radius: 6px;
                                        cursor: pointer;
                                        font-size: 16px;
                                    "
                                    data-i18n="save_button">
                                    Enregistrer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                (() => {
                    "use strict";
                    if (window.SiteRegional?.__inited) return; // évite double init

                    /************ CONFIG ************/
                    const TRANSLATIONS = {
                        "fr-FR": {
                            hero_title: "Décoration & Meubles d'Exception",
                            hero_description: "Découvrez notre collection exclusive de meubles et accessoires pour votre intérieur et extérieur",
                            hero_btn: "Découvrir la collection",
                            regional_settings: "Paramètres régionaux",
                            regional_text: "Paramétrez votre pays, votre langue, et la devise que vous utilisez.",
                            currency_label: "Devise",
                            country_label: "Pays/Région",
                            language_label: "Langue",
                            cancel_button: "Annuler",
                            save_button: "Enregistrer",
                            section_categories: "Nos Catégories",
                            section_new: "Nos Nouveautés",
                            newsletter_title: "Ne manquez aucune offre exceptionnelle !",
                            newsletter_cta: "Je profite des offres",
                            search_placeholder: "Rechercher des meubles, décoration...",
                        },
                        "en-US": {
                            hero_title: "Decoration & Exceptional Furniture",
                            hero_description: "Discover our exclusive collection of furniture and accessories for your indoor and outdoor spaces",
                            hero_btn: "Discover the collection",
                            regional_settings: "Regional Settings",
                            regional_text: "Set your country, language, and currency.",
                            currency_label: "Currency",
                            country_label: "Country/Region",
                            language_label: "Language",
                            cancel_button: "Cancel",
                            save_button: "Save",
                            section_categories: "Our Categories",
                            section_new: "New Arrivals",
                            newsletter_title: "Don't miss any great deals!",
                            newsletter_cta: "Get the deals",
                            search_placeholder: "Search for furniture, decor...",
                        },
                        "es-ES": {
                            hero_title: "Decoración y Muebles de Excepción",
                            hero_description: "Descubre nuestra colección exclusiva de muebles y accesorios para tu interior y exterior",
                            hero_btn: "Descubrir la colección",
                            regional_settings: "Configuración regional",
                            regional_text: "Configura tu país, idioma y moneda.",
                            currency_label: "Moneda",
                            country_label: "País/Región",
                            language_label: "Idioma",
                            cancel_button: "Cancelar",
                            save_button: "Guardar",
                            section_categories: "Nuestras categorías",
                            section_new: "Novedades",
                            newsletter_title: "¡No te pierdas ninguna oferta!",
                            newsletter_cta: "Quiero las ofertas",
                            search_placeholder: "Buscar muebles, decoración...",
                        },
                        "de-DE": {
                            hero_title: "Dekoration & Außergewöhnliche Möbel",
                            hero_description: "Entdecken Sie unsere exklusive Kollektion von Möbeln und Accessoires für Innen- und Außenbereiche",
                            hero_btn: "Kollektion entdecken",
                            regional_settings: "Regionale Einstellungen",
                            regional_text: "Stellen Sie Ihr Land, Ihre Sprache und Währung ein.",
                            currency_label: "Währung",
                            country_label: "Land/Region",
                            language_label: "Sprache",
                            cancel_button: "Abbrechen",
                            save_button: "Speichern",
                            section_categories: "Unsere Kategorien",
                            section_new: "Neuheiten",
                            newsletter_title: "Verpassen Sie keine Angebote!",
                            newsletter_cta: "Angebote sichern",
                            search_placeholder: "Möbel, Deko suchen...",
                        },
                        "pt-BR": {
                            hero_title: "Decoração e Móveis Excepcionais",
                            hero_description: "Descubra nossa coleção exclusiva de móveis e acessórios para ambientes internos e externos",
                            hero_btn: "Descubra a coleção",
                            regional_settings: "Configurações regionais",
                            regional_text: "Defina seu país, idioma e moeda.",
                            currency_label: "Moeda",
                            country_label: "País/Região",
                            language_label: "Idioma",
                            cancel_button: "Cancelar",
                            save_button: "Salvar",
                            section_categories: "Nossas categorias",
                            section_new: "Novidades",
                            newsletter_title: "Não perca nenhuma oferta!",
                            newsletter_cta: "Garanta as ofertas",
                            search_placeholder: "Buscar móveis, decoração...",
                        },

                        "it-IT": {
                            hero_title: "Decorazione e mobili d'eccezione",
                            hero_description: "Scopri la nostra collezione esclusiva di mobili e accessori per spazi interni ed esterni",
                            hero_btn: "Scopri la collezione",
                            regional_settings: "Impostazioni regionali",
                            regional_text: "Imposta il tuo paese, la lingua e la valuta.",
                            currency_label: "Valuta",
                            country_label: "Paese/Regione",
                            language_label: "Lingua",
                            cancel_button: "Annulla",
                            save_button: "Salva",
                            section_categories: "Le nostre categorie",
                            section_new: "Novità",
                            newsletter_title: "Non perdere nessuna offerta!",
                            newsletter_cta: "Approfitta delle offerte",
                            search_placeholder: "Cerca mobili, decorazioni...",
                        },

                        "nl-NL": {
                            hero_title: "Decoratie & Uitzonderlijke Meubels",
                            hero_description: "Ontdek onze exclusieve collectie meubels en accessoires voor binnen en buiten",
                            hero_btn: "Ontdek de collectie",
                            regional_settings: "Regionale instellingen",
                            regional_text: "Stel je land, taal en valuta in.",
                            currency_label: "Valuta",
                            country_label: "Land/regio",
                            language_label: "Taal",
                            cancel_button: "Annuleren",
                            save_button: "Opslaan",
                            section_categories: "Onze categorieën",
                            section_new: "Nieuw binnen",
                            newsletter_title: "Mis geen enkele aanbieding!",
                            newsletter_cta: "Pak de aanbiedingen",
                            search_placeholder: "Zoek naar meubels, decoratie...",
                        },

                        "zh-CN": {
                            hero_title: "家居装饰与臻品家具",
                            hero_description: "探索我们为室内与室外空间甄选的独家家具与配饰",
                            hero_btn: "探索系列",
                            regional_settings: "地区设置",
                            regional_text: "设置您的国家/地区、语言和货币。",
                            currency_label: "货币",
                            country_label: "国家/地区",
                            language_label: "语言",
                            cancel_button: "取消",
                            save_button: "保存",
                            section_categories: "我们的分类",
                            section_new: "新品上架",
                            newsletter_title: "不要错过任何优惠！",
                            newsletter_cta: "获取优惠",
                            search_placeholder: "搜索家具、装饰...",
                        },
                        "ja-JP": {
                            hero_title: "インテリア装飾＆厳選家具",
                            hero_description: "屋内外の空間に向けた、厳選の家具・アクセサリーコレクションをお楽しみください",
                            hero_btn: "コレクションを見る",
                            regional_settings: "地域設定",
                            regional_text: "お住まいの国／地域、言語、通貨を設定してください。",
                            currency_label: "通貨",
                            country_label: "国／地域",
                            language_label: "言語",
                            cancel_button: "キャンセル",
                            save_button: "保存",
                            section_categories: "カテゴリー",
                            section_new: "新着アイテム",
                            newsletter_title: "お得情報を見逃さないで！",
                            newsletter_cta: "お得情報を受け取る",
                            search_placeholder: "家具・インテリアを検索…",
                        },
                    };

                    const CURRENCY_LABEL = {
                        EUR: "€",
                        USD: "$",
                        GBP: "£",
                        CAD: "C$",
                        AUD: "A$",
                        JPY: "¥",
                        CHF: "CHF",
                        XOF: "F CFA",
                        XAF: "F CFA",
                    };
                    const COUNTRY_FLAG = (code) => (code || "FR").toLowerCase();

                    const PREFS = {
                        get locale() {
                            return localStorage.getItem("locale") || "fr-FR";
                        },
                        get currency() {
                            return localStorage.getItem("currency") || "EUR";
                        },
                        get country() {
                            return localStorage.getItem("country") || "FR";
                        },
                        setAll({
                            locale,
                            currency,
                            country
                        }) {
                            if (locale) localStorage.setItem("locale", locale);
                            if (currency) localStorage.setItem("currency", currency);
                            if (country) localStorage.setItem("country", country);
                        },
                    };

                    // Cache de taux (base EUR)
                    const FX = {
                        key: "fx_rates_v1",
                        ttlMs: 6 * 60 * 60 * 1000,
                        cached() {
                            try {
                                return JSON.parse(localStorage.getItem(this.key) || "null");
                            } catch {
                                return null;
                            }
                        },
                        save(p) {
                            localStorage.setItem(this.key, JSON.stringify(p));
                        },
                        async getLatest(base = "EUR") {
                            const now = Date.now();
                            const c = this.cached();
                            if (c && c.base === base && now - c.ts < this.ttlMs) return c; // instantané
                            try {
                                const res = await fetch(
                                    `https://api.exchangerate.host/latest?base=${encodeURIComponent(
                      base
                    )}`
                                );
                                const data = await res.json();
                                if (data?.rates) {
                                    const pack = {
                                        base: data.base,
                                        rates: data.rates,
                                        ts: now,
                                    };
                                    this.save(pack);
                                    return pack;
                                }
                            } catch {}
                            // fallback (approx)
                            const pack = {
                                base: "EUR",
                                ts: now,
                                rates: {
                                    EUR: 1,
                                    USD: 1.08,
                                    GBP: 0.85,
                                    CAD: 1.48,
                                    AUD: 1.62,
                                    JPY: 170,
                                    CHF: 0.95,
                                    XOF: 655.957,
                                    XAF: 655.957,
                                },
                            };
                            this.save(pack);
                            return pack;
                        },
                    };

                    /************ I18N ************/
                    function applyI18n(locale) {
                        const pack = TRANSLATIONS[locale] || TRANSLATIONS["fr-FR"];
                        document.documentElement.lang = (locale || "fr-FR").split(
                            "-"
                        )[0];

                        document.querySelectorAll("[data-i18n]").forEach((el) => {
                            const key = el.getAttribute("data-i18n");
                            if (pack[key]) el.textContent = pack[key];
                        });

                        document
                            .querySelectorAll("[data-i18n-placeholder]")
                            .forEach((el) => {
                                const key = el.getAttribute("data-i18n-placeholder");
                                if (pack[key]) el.setAttribute("placeholder", pack[key]);
                            });
                        document.querySelectorAll("[data-i18n-title]").forEach((el) => {
                            const key = el.getAttribute("data-i18n-title");
                            if (pack[key]) el.setAttribute("title", pack[key]);
                        });
                    }

                    /************ PRIX ************/
                    function fmt(amount, locale, currency) {
                        try {
                            return new Intl.NumberFormat(locale, {
                                style: "currency",
                                currency,
                            }).format(amount);
                        } catch {
                            return `${(amount || 0).toFixed(2)} ${CURRENCY_LABEL[currency] || currency
                  }`;
                        }
                    }

                    // peinture ultra-rapide : afficher le prix dans sa devise d’origine (sans conversion)
                    function fastPaintPrices(locale) {
                        document.querySelectorAll("[data-price]").forEach((el) => {
                            const amt =
                                parseFloat(el.getAttribute("data-price") || "0") || 0;
                            const cur = (
                                el.getAttribute("data-currency") || "EUR"
                            ).toUpperCase();
                            el.textContent = fmt(amt, locale, cur);
                        });
                    }

                    // conversion si besoin (ne télécharge pas les taux si inutile)
                    async function convertPrices(locale, targetCurrency) {
                        const els = Array.from(
                            document.querySelectorAll("[data-price]")
                        );
                        if (!els.length) return;

                        const to = (targetCurrency || "EUR").toUpperCase();
                        const allAlreadyTarget = els.every(
                            (el) =>
                            (
                                el.getAttribute("data-currency") || "EUR"
                            ).toUpperCase() === to
                        );
                        if (allAlreadyTarget) {
                            // juste reformater selon la locale
                            els.forEach((el) => {
                                const amt =
                                    parseFloat(el.getAttribute("data-price") || "0") || 0;
                                el.textContent = fmt(amt, locale, to);
                            });
                            return;
                        }

                        // essaie taux en cache immédiatement
                        const cached = FX.cached();
                        const fx =
                            cached && cached.base === "EUR" ?
                            cached :
                            await FX.getLatest("EUR");

                        els.forEach((el) => {
                            const baseAmt =
                                parseFloat(el.getAttribute("data-price") || "0") || 0;
                            const baseCur = (
                                el.getAttribute("data-currency") || "EUR"
                            ).toUpperCase();

                            let inEUR = baseAmt;
                            if (baseCur !== fx.base) {
                                const r = fx.rates[baseCur];
                                inEUR = r ? baseAmt / r : baseAmt;
                            }
                            const rateTo = fx.rates[to] || 1;
                            const converted = inEUR * rateTo;
                            el.textContent = fmt(converted, locale, to);
                        });
                    }

                    /************ UI ************/
                    function updateFlagAndCode(country) {
                        const flag = document.querySelector(".country-flag");
                        const code = document.querySelector(".country-code");
                        if (flag)
                            flag.style.backgroundImage = `url('https://flagcdn.com/w20/${COUNTRY_FLAG(
                  country
                )}.png')`;
                        if (code) code.textContent = (country || "FR").toUpperCase();
                    }

                    async function applyRegionalSettings({
                        locale,
                        currency,
                        country,
                    }) {
                        if (locale) applyI18n(locale);
                        // prix : d’abord peinture rapide, puis conversion après le rendu
                        fastPaintPrices(locale || PREFS.locale);
                        setTimeout(
                            () =>
                            convertPrices(
                                locale || PREFS.locale,
                                currency || PREFS.currency
                            ),
                            0
                        );

                        if (country) updateFlagAndCode(country);
                        PREFS.setAll({
                            locale,
                            currency,
                            country
                        });
                    }

                    /************ INIT ************/
                    window.addEventListener("DOMContentLoaded", async () => {
                        const initialLocale =
                            localStorage.getItem("locale") ||
                            (TRANSLATIONS[navigator.language] ?
                                navigator.language :
                                "fr-FR");
                        const initialCurrency =
                            localStorage.getItem("currency") || "EUR";
                        const initialCountry = localStorage.getItem("country") || "FR";

                        // pré-remplir le modal si présent
                        const languageSelect = document.getElementById("language");
                        const currencySelect = document.getElementById("currency");
                        const countrySelect = document.getElementById("country");
                        if (languageSelect) languageSelect.value = initialLocale;
                        if (currencySelect) currencySelect.value = initialCurrency;
                        if (countrySelect) countrySelect.value = initialCountry;

                        // appliquer très vite
                        await applyRegionalSettings({
                            locale: initialLocale,
                            currency: initialCurrency,
                            country: initialCountry,
                        });

                        // header modal
                        const modal = document.getElementById("dropdownCountry");
                        const toggleBtn = document.getElementById("countryToggle");
                        const closeBtn = modal?.querySelector(".close");
                        const cancelBtn = modal?.querySelector(".cancel-btn");
                        const regionForm = document.getElementById("regionForm");

                        toggleBtn?.addEventListener("click", () => {
                            if (modal) modal.style.display = "block";
                        });
                        closeBtn?.addEventListener("click", () => {
                            if (modal) modal.style.display = "none";
                        });
                        cancelBtn?.addEventListener("click", () => {
                            if (modal) modal.style.display = "none";
                        });
                        window.addEventListener("click", (e) => {
                            if (e.target === modal) modal.style.display = "none";
                        });

                        regionForm?.addEventListener("submit", async (e) => {
                            e.preventDefault();
                            const locale =
                                document.getElementById("language")?.value || "fr-FR";
                            const currency = (
                                document.getElementById("currency")?.value || "EUR"
                            ).toUpperCase();
                            const country = (
                                document.getElementById("country")?.value || "FR"
                            ).toUpperCase();
                            await applyRegionalSettings({
                                locale,
                                currency,
                                country
                            });
                            if (modal) modal.style.display = "none";
                        });

                        // mobile form (si présent)
                        const mobileForm = document.getElementById("mobileRegionForm");
                        mobileForm?.addEventListener("submit", async (e) => {
                            e.preventDefault();
                            const fd = new FormData(mobileForm);
                            const currency = (fd.get("currency") || "EUR").toUpperCase();
                            const country = (fd.get("country") || "FR").toUpperCase();
                            const lang = fd.get("language") || "fr";
                            const map = {
                                fr: "fr-FR",
                                en: "en-US",
                                es: "es-ES",
                                de: "de-DE",
                            };
                            const locale = map[lang] || "fr-FR";
                            await applyRegionalSettings({
                                locale,
                                currency,
                                country
                            });

                            // refermer le sous-menu mobile
                            const back = document.getElementById("mobileMenuBack");
                            const regionMenu = document.getElementById("regionMenu");
                            const mainMenu = document.getElementById("mobileMainMenu");
                            if (regionMenu && mainMenu && back) {
                                regionMenu.style.display = "none";
                                mainMenu.style.display = "block";
                                back.style.display = "none";
                            }
                        });
                    });

                    // (optionnel) observer si tu ajoutes du contenu dynamiquement
                    const ENABLE_OBSERVER = false;
                    if (ENABLE_OBSERVER) {
                        let t;
                        const mo = new MutationObserver(() => {
                            // throttle
                            clearTimeout(t);
                            t = setTimeout(() => {
                                applyI18n(PREFS.locale);
                                convertPrices(PREFS.locale, PREFS.currency);
                            }, 100);
                        });
                        mo.observe(document.body, {
                            childList: true,
                            subtree: true
                        });
                    }

                    window.SiteRegional = {
                        __inited: true,
                        apply: applyRegionalSettings,
                    };
                })();
            </script>

            {{--  @auth
               Si l’utilisateur est connecté, lien vers la page de checkout --}}
            {{-- <a id="cart-link" href="{{ route('checkout') }}"
                    style="position: relative; color: white; text-decoration: none; padding: 6px;">
                    <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                    <span class="cart-count"
                        style="
                            position: absolute;
                            top: -5px;
                            right: -5px;
                            background: white;
                            color: #4a6bff;
                            border-radius: 50%;
                            width: 18px;
                            height: 18px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            font-size: 11px;
                            font-weight: bold;
                        ">
                        {{ session('cart_count', 0) }}
                    </span>
                </a>
            @else
                {{-- Si l’utilisateur n’est pas connecté, rediriger vers login --}}
            {{-- <a id="cart-link" href="{{ route('login') }}"
                    style="position: relative; color: white; text-decoration: none; padding: 6px;">
                    <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                </a>
            @endauth  --}}



        </div>
    </div>
</header>

<!-- Modal mobile menu -->
<!-- Modal mobile menu -->
<div id="mobileMenuModal"
    style="
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        z-index: 999;
        overflow-y: auto;
        padding: 60px 20px 20px;
        box-sizing: border-box;
      ">
    <button id="closeMobileMenu"
        style="
          position: absolute;
          top: 20px;
          right: 20px;
          background: none;
          border: none;
          font-size: 24px;
          cursor: pointer;
          color: white;
        ">
        &times;
    </button>

    <div
        style="
          max-width: 500px;
          margin: 0 auto;
          background: white;
          border-radius: 10px;
          padding: 20px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        ">
        <!-- Bouton de retour (visible seulement dans les sous-menus) -->
        <button id="mobileMenuBack"
            style="
            display: none;
            background: none;
            border: none;
            color: #1f4e5f;
            font-size: 16px;
            margin-bottom: 15px;
            cursor: pointer;
          ">
            <i class="fas fa-arrow-left" style="margin-right: 8px"></i> Retour
        </button>

        <!-- Menu principal -->
        <div id="mobileMainMenu">
            <div style="padding: 20px 0">
                <!-- Menu utilisateur -->
                <div style="margin-bottom: 25px">
                    <h3
                        style="
                  color: #1f4e5f;
                  border-bottom: 1px solid #eee;
                  padding-bottom: 10px;
                  margin-bottom: 15px;
                ">
                        Mon compte
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 8px">
                        @auth
                            <a href="{{ route('profile') }}"
                                style="
                    display: flex;
                    align-items: center;
                    padding: 12px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 5px;
                    background: #f9f9f9;
                    transition: all 0.2s;
                  ">
                                <i class="fas fa-user-circle"
                                    style="
                      margin-right: 12px;
                      color: #4a6bff;
                      width: 20px;
                      text-align: center;
                    "></i>
                                <span>Mon profil</span>
                            </a>
                        @endauth

                        <a href="#"
                            style="
                    display: flex;
                    align-items: center;
                    padding: 12px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 5px;
                    background: #f9f9f9;
                    transition: all 0.2s;
                  ">
                            <i class="fas fa-heart"
                                style="
                      margin-right: 12px;
                      color: #ff4081;
                      width: 20px;
                      text-align: center;
                    "></i>
                            <span>Mes favoris</span>
                            <span
                                style="
                      margin-left: auto;

                      color: white;
                      font-size: 12px;
                      padding: 2px 8px;
                      border-radius: 10px;
                    "></span>
                        </a>
                        <a href="commandes.html"
                            style="
                    display: flex;
                    align-items: center;
                    padding: 12px 15px;
                    color: #333;
                    text-decoration: none;
                    font-size: 16px;
                    border-radius: 5px;
                    background: #f9f9f9;
                    transition: all 0.2s;
                  ">
                            <i class="fas fa-box-open"
                                style="
                      margin-right: 12px;
                      color: #4caf50;
                      width: 20px;
                      text-align: center;
                    "></i>
                            <span>Mes commandes</span>
                        </a>
                    </div>
                </div>

                <!-- Profil professionnel -->
                <div style="margin-bottom: 25px">
                    @auth
                        <a class="desktop-only" href="{{ route('profile') }}" style="...">
                            <i class="fas fa-user" style="font-size: 14px"></i>
                            <span>{{ Auth::user()->name }} — {{ Auth::user()->role }}</span>
                        </a>
                    @else
                        <a class="auth-link desktop-only" href="{{ route('login') }}"
                            style="
                    font-size: 14px;
                    color: white;
                    background: rgba(255, 255, 255, 0.1);
                    padding: 8px 15px;
                    border-radius: 20px;
                    text-decoration: none;
                    transition: all 0.2s;
                    display: flex;
                    align-items: center;
                    gap: 6px;
                    ">
                            <i class="fas fa-briefcase" style="font-size: 14px"></i>
                            <span>S'inscrire</span>
                        </a>
                    @endauth
                </div>

                <!-- Menu Aide -->
                <div style="margin-bottom: 25px">
                    <button class="mobile-menu-section" data-target="helpMenu"
                        style="
                  width: 100%;
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  padding: 12px 15px;
                  color: #333;
                  text-decoration: none;
                  font-size: 16px;
                  border-radius: 5px;
                  background: #f9f9f9;
                  border: none;
                  cursor: pointer;
                  text-align: left;
                ">
                        <span>
                            <i class="fas fa-question-circle" style="margin-right: 12px; color: #4a6bff"></i>
                            Aide & Contact
                        </span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>

                <!-- Paramètres régionauxrosine-->
                <div style="margin-bottom: 25px">
                    <button class="mobile-menu-section" data-target="regionMenu"
                        style="
                  width: 100%;
                  display: flex;
                  align-items: center;
                  justify-content: space-between;
                  padding: 12px 15px;
                  color: #333;
                  text-decoration: none;
                  font-size: 16px;
                  border-radius: 5px;
                  background: #f9f9f9;
                  border: none;
                  cursor: pointer;
                  text-align: left;
                ">
                        <span>
                            <i class="fas fa-globe" style="margin-right: 12px; color: #4a6bff"></i>
                            Paramètres régionaux
                        </span>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>


                <!-- Panier -->
                <div>
                    @auth
                        <a id="cart-link" href="{{ route('checkout') }}"
                            style="
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                padding: 12px 15px;
                                color: white;
                                background: #4a6bff;
                                border-radius: 5px;
                                text-decoration: none;
                                font-size: 16px;
                                font-weight: 500;
                                transition: all 0.2s;
                            ">
                            <i class="fas fa-shopping-cart" style="margin-right: 10px"></i>
                            <span>Panier</span>
                            <span class="cart-count"
                                style="
                                margin-left: 8px;
                                background: white;
                                color: #4a6bff;
                                border-radius: 50%;
                                width: 22px;
                                height: 22px;
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                font-size: 12px;
                            ">
                                {{-- Tu peux insérer ici le nombre d’articles si tu l’as --}}
                                {{ session('cart_count', 0) }}
                            </span>
                        </a>
                    @else
                        <a id="cart-link" href="{{ route('login') }}"
                            style="
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                padding: 12px 15px;
                                color: white;
                                background: #4a6bff;
                                border-radius: 5px;
                                text-decoration: none;
                                font-size: 16px;
                                font-weight: 500;
                                transition: all 0.2s;
                            ">
                            <i class="fas fa-shopping-cart" style="margin-right: 10px"></i>
                            <span>S'inscrire</span>
                        </a>
                    @endauth


                </div>
            </div>
        </div>

        <!-- Sous-menu Aide -->
        <div id="helpMenu" style="display: none">
            <h3
                style="
              color: #1f4e5f;
              border-bottom: 1px solid #eee;
              padding-bottom: 10px;
              margin-bottom: 15px;
            ">
                <i class="fas fa-question-circle" style="margin-right: 10px"></i>
                Aide & Contact
            </h3>
            <div style="display: flex; flex-direction: column; gap: 8px">
                <a href="#"
                    style="
                display: flex;
                align-items: center;
                padding: 12px 15px;
                color: #333;
                text-decoration: none;
                font-size: 16px;
                border-radius: 5px;
                background: #f9f9f9;
                transition: all 0.2s;
              ">
                    <i class="fas fa-truck"
                        style="
                  margin-right: 12px;
                  color: #4a6bff;
                  width: 20px;
                  text-align: center;
                "></i>
                    <span>Suivre ma commande</span>
                </a>


                <a href="#"
                    style="
                display: flex;
                align-items: center;
                padding: 12px 15px;
                color: #333;
                text-decoration: none;
                font-size: 16px;
                border-radius: 5px;
                background: #f9f9f9;
                transition: all 0.2s;
              ">
                    <i class="fas fa-phone-alt"
                        style="
                  margin-right: 12px;
                  color: #4a6bff;
                  width: 20px;
                  text-align: center;
                "></i>
                    <span>Contactez-nous</span>
                </a>
            </div>
        </div>

        <!-- Sous-menu Paramètres régionaux -->
        <div id="regionMenu" style="display: none">
            <h3
                style="
              color: #1f4e5f;
              border-bottom: 1px solid #eee;
              padding-bottom: 10px;
              margin-bottom: 15px;
            ">
                <i class="fas fa-globe" style="margin-right: 10px"></i>
                Paramètres régionaux
            </h3>

            <form id="mobileRegionForm" style="margin-bottom: 20px">
                <div style="margin-bottom: 15px">
                    <label
                        style="
                  display: block;
                  margin-bottom: 8px;
                  font-weight: 600;
                  color: #555;
                ">Devise</label>
                    <select name="currency"
                        style="
                  width: 100%;
                  padding: 10px;
                  border: 1px solid #ddd;
                  border-radius: 6px;
                  font-size: 16px;
                  background: white;
                ">
                        <option value="EUR">Euro (€)</option>
                        <option value="USD">Dollar US ($)</option>
                        <option value="GBP">Livre sterling (£)</option>
                        <option value="CAD">Dollar canadien (C$)</option>
                    </select>
                </div>

                <div style="margin-bottom: 15px">
                    <label
                        style="
                  display: block;
                  margin-bottom: 8px;
                  font-weight: 600;
                  color: #555;
                ">Pays/Région</label>
                    <select name="country"
                        style="
                  width: 100%;
                  padding: 10px;
                  border: 1px solid #ddd;
                  border-radius: 6px;
                  font-size: 16px;
                  background: white;
                ">
                        <option value="FR">France</option>
                        <option value="BE">Belgique</option>
                        <option value="CH">Suisse</option>
                        <option value="CA">Canada</option>
                        <option value="US">États-Unis</option>
                    </select>
                </div>

                <div style="margin-bottom: 20px">
                    <label
                        style="
                  display: block;
                  margin-bottom: 8px;
                  font-weight: 600;
                  color: #555;
                ">Langue</label>
                    <select name="language"
                        style="
                  width: 100%;
                  padding: 10px;
                  border: 1px solid #ddd;
                  border-radius: 6px;
                  font-size: 16px;
                  background: white;
                ">
                        <option value="fr">Français</option>
                        <option value="en">English</option>
                        <option value="es">Español</option>
                        <option value="de">Deutsch</option>
                    </select>
                </div>

                <div style="display: flex; gap: 10px">
                    <button type="button" class="cancel-region"
                        style="
                  flex: 1;
                  padding: 12px;
                  background: #f5f5f5;
                  border: 1px solid #ddd;
                  border-radius: 6px;
                  cursor: pointer;
                  font-size: 16px;
                ">
                        Annuler
                    </button>
                    <button type="submit"
                        style="
                  flex: 1;
                  padding: 12px;
                  background: #1f4e5f;
                  color: white;
                  border: none;
                  border-radius: 6px;
                  cursor: pointer;
                  font-size: 16px;
                ">
                        Appliquer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
