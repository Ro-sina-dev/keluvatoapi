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

                        @auth
                            <a href="{{ route('favorites.index') }}"
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
                        @endauth
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
                <a class="" href="{{ route('profile') }}"
                    style="font-size: 14px;
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
                <a class="auth-link " href="{{ route('login') }}"
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

            @auth
                {{--  Si l’utilisateur est connecté, lien vers la page de checkout --}}
                <a id="cart-link" href="{{ route('checkout') }}"
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
                <a id="cart-link" href="{{ route('login') }}"
                    style="position: relative; color: white; text-decoration: none; padding: 6px;">
                    <i class="fas fa-shopping-cart" style="font-size: 20px;"></i>
                </a>
            @endauth



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
                        @auth
                            <a href="{{ route('favorites.index') }}"
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
                        @endauth

                        <a href="{{ route('orders') }}"
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
                        <a class="mobile-only" href="{{ route('profile') }}" style="...">
                            <!--  <i class="fas fa-user" style="font-size: 14px"></i>
                                    <span>{{ Auth::user()->name }} — {{ Auth::user()->role }}</span> -->
                        </a>
                    @else
                        <a class="auth-link mobile-only" href="{{ route('login') }}"
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


<script>
    (() => {
        const input = document.getElementById('searchInput');
        const button = document.getElementById('searchBtn');
        const dd = document.getElementById('searchDropdown');

        if (!input || !button || !dd) return;

        const suggestUrl = @json(route('search.suggest'));
        const resultsUrl = @json(route('search.results'));

        let timer = null;

        const hideDD = () => {
            dd.style.display = 'none';
            dd.innerHTML = '';
        };
        const showDD = () => {
            dd.style.display = 'block';
        };

        const renderSuggestions = (data) => {
            const {
                products = [], categories = []
            } = data || {};
            if (!products.length && !categories.length) {
                hideDD();
                return;
            }

            const escape = (s) => (s || '').toString().replace(/</g, '&lt;').replace(/>/g, '&gt;');

            let html = '';

            if (products.length) {
                html += '<div style="padding:8px 10px; font-weight:600; color:#1f4e5f">Produits</div>';
                products.forEach(p => {
                    html += `
          <a href="${escape(p.url)}" style="display:flex; gap:10px; padding:10px; text-decoration:none; color:#222; align-items:center">
            <img src="${escape(p.img)}" alt="" style="width:44px; height:44px; object-fit:cover; border-radius:6px">
            <div style="display:flex; flex-direction:column">
              <strong style="font-size:14px">${escape(p.name)}</strong>
              <small style="color:#6b7280">${escape(p.price)}</small>
            </div>
          </a>`;
                });
                html += '<hr style="border:none; border-top:1px solid #eee; margin:0">';
            }

            if (categories.length) {
                html += '<div style="padding:8px 10px; font-weight:600; color:#1f4e5f">Catégories</div>';
                categories.forEach(c => {
                    html += `
          <a href="${escape(c.url)}" style="display:block; padding:10px; text-decoration:none; color:#222">
            <i class="fas fa-tag" style="margin-right:8px; color:#6b7280"></i>${escape(c.name)}
          </a>`;
                });
            }

            dd.innerHTML = html;
            showDD();
        };

        const fetchSuggestions = async (q) => {
            try {
                const url = new URL(suggestUrl, window.location.origin);
                url.searchParams.set('q', q);
                const res = await fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) {
                    hideDD();
                    return;
                }
                const data = await res.json();
                renderSuggestions(data);
            } catch (_) {
                hideDD();
            }
        };

        const goSearch = () => {
            const q = input.value.trim();
            if (!q) return;
            window.location.assign(resultsUrl + '?q=' + encodeURIComponent(q));
        };

        input.addEventListener('input', () => {
            const q = input.value.trim();
            if (timer) clearTimeout(timer);
            if (q.length < 2) {
                hideDD();
                return;
            }
            timer = setTimeout(() => fetchSuggestions(q), 220); // debounce
        });

        input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                goSearch();
            } else if (e.key === 'Escape') {
                hideDD();
                input.blur();
            }
        });

        button.addEventListener('click', (e) => {
            e.preventDefault();
            goSearch();
        });

        document.addEventListener('click', (e) => {
            if (!dd.contains(e.target) && e.target !== input && e.target !== button) {
                hideDD();
            }
        });
    })();
</script>


<script>
    // Menus User & Aide — version simple et robuste
    (function() {
        const userToggle = document.getElementById("userToggle");
        const dropdownUser = document.getElementById("dropdownUser");
        const helpToggle = document.getElementById("helpToggle");
        const dropdownHelp = document.getElementById("dropdownHelp");

        function toggle(el) {
            if (!el) return;
            el.style.display = el.style.display === "block" ? "none" : "block";
        }

        function hideAll() {
            [dropdownUser, dropdownHelp].forEach((d) => {
                if (d) d.style.display = "none";
            });
        }

        if (userToggle && dropdownUser) {
            userToggle.addEventListener("click", (e) => {
                e.stopPropagation();
                hideAll();
                toggle(dropdownUser);
            });
        }
        if (helpToggle && dropdownHelp) {
            helpToggle.addEventListener("click", (e) => {
                e.stopPropagation();
                hideAll();
                toggle(dropdownHelp);
            });
        }

        document.addEventListener("click", hideAll);
    })();
</script>



<script>
    (function() {
        const input = document.getElementById('searchInput');
        const btn = document.getElementById('searchBtn');
        const dd = document.getElementById('searchDropdown');

        let cursor = -1; // index sélection clavier
        let items = []; // cache items affichés
        let lastQ = '';
        const DEBOUNCE_MS = 180;

        // util: debounce
        const debounce = (fn, ms) => {
            let t;
            return (...args) => {
                clearTimeout(t);
                t = setTimeout(() => fn(...args), ms);
            };
        };

        // util: première image
        const firstImage = (images) => {
            if (!images) return '';
            if (Array.isArray(images) && images[0]) return images[0];
            if (typeof images === 'string') {
                try {
                    const arr = JSON.parse(images);
                    if (Array.isArray(arr) && arr[0]) return arr[0];
                } catch (e) {}
            }
            return '';
        };

        // rendu dropdown
        function render(q, data) {
            items = data || [];
            cursor = -1;

            if (!q || !items.length) {
                dd.innerHTML = q ? `
      <div class="search-empty">Aucun résultat pour “${escapeHtml(q)}”.</div>` : '';
                dd.style.display = q ? 'block' : 'none';
                if (q) dd.innerHTML += footer(q, 0);
                return;
            }

            const html = [
                ...items.map((p, i) => {
                    const img = firstImage(p.images) || 'https://via.placeholder.com/80x80?text=—';
                    const price = (p.price != null) ? `${Number(p.price).toFixed(2)} ${p.currency || ''}` :
                        '';
                    return `
          <div class="search-item" data-index="${i}" data-id="${p.id}">
            <img class="search-thumb" src="${img}" alt="">
            <div>
              <div class="search-title">${escapeHtml(p.name)}</div>
              <div class="search-price">${escapeHtml(price)}</div>
            </div>
          </div>
        `;
                })
            ].join('');

            dd.innerHTML = html + footer(q, items.length);
            dd.style.display = 'block';

            // Bind click
            dd.querySelectorAll('.search-item').forEach(el => {
                el.addEventListener('click', () => {
                    const id = el.getAttribute('data-id');
                    goToProduct(id);
                });
            });

            // “Voir tous les résultats”
            const allLink = dd.querySelector('#searchSeeAll');
            if (allLink) allLink.addEventListener('click', (e) => {
                e.preventDefault();
                goToResults(q);
            });
        }

        //function footer(q, count) {
        // return `
        //  <div class="search-footer">
        //   <span>${count} résultat${count>1?'s':''}</span>
        //  <a href="#" id="searchSeeAll">Voir tous les résultats pour “${escapeHtml(q)}”</a>
        // </div>
        //`;
        //}

        // sécurité HTML
        function escapeHtml(s) {
            return String(s).replace(/[&<>"']/g, m => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;'
            } [m]));
        }

        // navigation
        function goToProduct(id) {
            if (!id) return;
            window.location.href = `product.html?id=${encodeURIComponent(id)}`;
        }

        function goToResults(q) {
            // page résultats de ton choix
            window.location.href = `recherche.html?q=${encodeURIComponent(q)}`;
        }

        // fetch suggestions
        const doSearch = debounce(async (q) => {
            q = q.trim();
            lastQ = q;
            if (!q) {
                dd.style.display = 'none';
                dd.innerHTML = '';
                return;
            }

            try {
                const res = await fetch(`${apiBase}/search?q=${encodeURIComponent(q)}`, {
                    headers: {
                        Accept: 'application/json'
                    }
                });
                const data = await res.json();
                // si l’utilisateur a déjà tapé autre chose, on ignore
                if (q !== lastQ) return;
                render(q, Array.isArray(data) ? data : []);
            } catch (e) {
                console.error(e);
                render(q, []);
            }
        }, DEBOUNCE_MS);

        // events
        input.addEventListener('input', (e) => doSearch(e.target.value));
        input.addEventListener('focus', () => {
            if (input.value.trim()) doSearch(input.value);
        });

        // bouton loupe = page résultats complète
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const q = input.value.trim();
            if (!q) return;
            goToResults(q);
        });

        // clavier: Entrée / Échap / ↑ / ↓
        input.addEventListener('keydown', (e) => {
            if (dd.style.display !== 'block') return;
            const max = items.length - 1;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                cursor = (cursor < max) ? cursor + 1 : 0;
                updateActive();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                cursor = (cursor > 0) ? cursor - 1 : max;
                updateActive();
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (cursor >= 0 && items[cursor]) goToProduct(items[cursor].id);
                else if (input.value.trim()) goToResults(input.value.trim());
            } else if (e.key === 'Escape') {
                dd.style.display = 'none';
            }
        });

        function updateActive() {
            dd.querySelectorAll('.search-item').forEach((el, i) => {
                if (i === cursor) {
                    el.classList.add('active');
                    el.scrollIntoView({
                        block: 'nearest'
                    });
                } else {
                    el.classList.remove('active');
                }
            });
        }

        // fermer si clic dehors
        document.addEventListener('click', (e) => {
            if (!dd.contains(e.target) && e.target !== input) {
                dd.style.display = 'none';
            }
        });
    })();
</script>



<script>
    (function() {
        const CART_KEY = "cart";
        let cart = JSON.parse(localStorage.getItem(CART_KEY) || "[]");

        // DOM
        const cartLink = document.getElementById("cart-link");
        const cartCountEl = cartLink ?
            cartLink.querySelector(".cart-count") :
            null;
        const checkoutModal = document.getElementById("checkout-modal");
        const closeModal = checkoutModal ?
            checkoutModal.querySelector(".close-modal") :
            null;
        const cartItemsContainer = document.getElementById("cart-items");
        const subtotalElement = document.getElementById("subtotal");
        const totalElement = document.getElementById("total");

        // Utils
        const euro = (n) => `€${Number(n).toFixed(2)}`;
        const saveCart = () =>
            localStorage.setItem(CART_KEY, JSON.stringify(cart));

        function updateCartCount() {
            if (!cartCountEl) return;
            const totalItems = cart.reduce((t, i) => t + i.quantity, 0);
            cartCountEl.textContent = totalItems;
        }

        function updateCartDisplay() {
            if (!cartItemsContainer || !subtotalElement || !totalElement) return;

            cartItemsContainer.innerHTML = "";
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = "<p>Votre panier est vide.</p>";
                subtotalElement.textContent = euro(0);
                totalElement.textContent = euro(0);
                return;
            }

            let subtotal = 0;
            cart.forEach((item) => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                const row = document.createElement("div");
                row.className = "summary-item";
                row.innerHTML = `<span>${item.name} x${item.quantity
                        }</span><span>${euro(itemTotal)}</span>`;
                cartItemsContainer.appendChild(row);
            });

            subtotalElement.textContent = euro(subtotal);
            totalElement.textContent = euro(subtotal);
        }

        // Ajouter au panier
        document.querySelectorAll(".btn-add-to-cart").forEach((btn) => {
            btn.addEventListener("click", () => {
                const id = btn.getAttribute("data-id");
                const name = btn.getAttribute("data-name");
                const price = parseFloat(btn.getAttribute("data-price") || "0");

                const existing = cart.find((i) => i.id === id);
                if (existing) existing.quantity += 1;
                else cart.push({
                    id,
                    name,
                    price,
                    quantity: 1
                });

                saveCart();
                updateCartCount();
                alert(`${name} a été ajouté à votre panier !`);
            });
        });

        // Clic sur l'icône Panier
        if (cartLink) {
            cartLink.addEventListener("click", (e) => {
                e.preventDefault();
                const userToken = localStorage.getItem("userToken");

                // Non connecté → login
                if (!userToken) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }

                // Connecté → modal si présent, sinon page panier
                if (checkoutModal) {
                    updateCartDisplay();
                    checkoutModal.style.display = "block";
                } else {
                    window.location.href = "{{ route('checkout') }}";
                }
            });
        }

        // Fermeture du modal
        if (closeModal && checkoutModal) {
            closeModal.addEventListener(
                "click",
                () => (checkoutModal.style.display = "none")
            );
            window.addEventListener("click", (e) => {
                if (e.target === checkoutModal)
                    checkoutModal.style.display = "none";
            });
        }

        // Init compteur
        updateCartCount();
    })();
</script>

<script src="js/app-auth.js" defer></script>

<!-- À placer juste avant </body> pour optimiser le chargement -->
<script src="js/main.js"></script>

<script src="js/cart-core.js" defer></script>

<script>
    (function() {
        function c() {
            var b = a.contentDocument || a.contentWindow.document;
            if (b) {
                var d = b.createElement("script");
                d.innerHTML =
                    "window.__CF$cv$params={r:'95b1de7461e0b7a5',t:'MTc1MTgzMzkyMS4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                b.getElementsByTagName("head")[0].appendChild(d);
            }
        }
        if (document.body) {
            var a = document.createElement("iframe");
            a.height = 1;
            a.width = 1;
            a.style.position = "absolute";
            a.style.top = 0;
            a.style.left = 0;
            a.style.border = "none";
            a.style.visibility = "hidden";
            document.body.appendChild(a);
            if ("loading" !== document.readyState) c();
            else if (window.addEventListener)
                document.addEventListener("DOMContentLoaded", c);
            else {
                var e = document.onreadystatechange || function() {};
                document.onreadystatechange = function(b) {
                    e(b);
                    "loading" !== document.readyState &&
                        ((document.onreadystatechange = e), c());
                };
            }
        }
    })();








    // Script pour gérer l'affichage mobile
    document.addEventListener("DOMContentLoaded", function() {
        // Gestion du menu burger
        const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
        const mobileMenuModal = document.getElementById("mobileMenuModal");
        const closeMobileMenu = document.getElementById("closeMobileMenu");

        if (mobileMenuToggle && mobileMenuModal) {
            mobileMenuToggle.addEventListener("click", function() {
                mobileMenuModal.style.display = "block";
                document.body.style.overflow = "hidden";
            });
        }

        if (closeMobileMenu && mobileMenuModal) {
            closeMobileMenu.addEventListener("click", function() {
                mobileMenuModal.style.display = "none";
                document.body.style.overflow = "auto";
            });
        }

        // Fermer le modal si on clique en dehors
        mobileMenuModal.addEventListener("click", function(e) {
            if (e.target === mobileMenuModal) {
                mobileMenuModal.style.display = "none";
                document.body.style.overflow = "auto";
            }
        });

        // Gestion des menus déroulants desktop
        const toggleButtons = document.querySelectorAll('[id$="Toggle"]');
        toggleButtons.forEach((button) => {
            button.addEventListener("click", function(e) {
                e.stopPropagation();
                const dropdownId = this.id.replace("Toggle", "");
                const dropdown = document.getElementById(dropdownId);
                const isVisible = dropdown.style.display === "block";

                // Fermer tous les autres menus
                document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                    if (menu.id !== dropdownId) {
                        menu.style.display = "none";
                    }
                });

                // Basculer l'affichage du menu courant
                dropdown.style.display = isVisible ? "none" : "block";
            });
        });

        // Fermer les menus déroulants quand on clique ailleurs
        document.addEventListener("click", function() {
            document.querySelectorAll(".dropdown-menu").forEach((menu) => {
                menu.style.display = "none";
            });
        });

        // Empêcher la fermeture quand on clique dans le menu
        document.querySelectorAll(".dropdown-menu").forEach((menu) => {
            menu.addEventListener("click", function(e) {
                e.stopPropagation();
            });
        });

        // Fonction pour changer la langue
        window.changeLanguage = function(lang) {
            console.log("Changement de langue vers:", lang);
            // Ici vous ajouteriez la logique pour changer la langue
            document.querySelectorAll(".language-code").forEach((el) => {
                el.textContent = lang.toUpperCase();
            });
            document.getElementById("mobileMenuModal").style.display = "none";
            document.body.style.overflow = "auto";
        };
    });












    let lastScrollTop = 0;
    const header = document.getElementById("mainHeader");

    window.addEventListener("scroll", function() {
        const scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // On descend → cacher le header
            header.style.top = "-150px"; // adapte cette valeur à la hauteur de ton header
        } else {
            // On remonte → afficher le header
            header.style.top = "0";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // pour éviter valeurs négatives
    });


















    // Chargement différé pour améliorer les performances
    document.addEventListener("DOMContentLoaded", function() {
        const iframe = document.querySelector(".youtube-container iframe");
        iframe.setAttribute("src", iframe.getAttribute("src"));
    });





    // Liste complète des pays (exemple partiel)
    const countrie = [{
            code: "FR",
            name: "France",
            currency: "EUR",
            symbol: "€",
            flag: "fr",
        },
        {
            code: "DE",
            name: "Allemagne",
            currency: "EUR",
            symbol: "€",
            flag: "de",
        },
        {
            code: "US",
            name: "États-Unis",
            currency: "USD",
            symbol: "$",
            flag: "us",
        },
        // ... autres pays ...
    ];

    // Dictionnaire de traduction
    const translations = {
        fr: {
            search_placeholder: "Rechercher des meubles, décoration...",
            select_country: "Sélectionnez votre pays",
            search_country: "Rechercher un pays...",
        },
        en: {
            search_placeholder: "Search for furniture, decor...",
            select_country: "Select your country",
            search_country: "Search for a country...",
        },
        es: {
            search_placeholder: "Buscar muebles, decoración...",
            select_country: "Selecciona tu país",
            search_country: "Buscar un país...",
        },
    };

    // Langue par défaut
    let currentLanguage = "fr";

    // Fonction pour changer la langue
    function changeLanguage(lang) {
        currentLanguage = lang;
        document.querySelector(".language-code").textContent =
            lang.toUpperCase();
        document.getElementById("dropdownLanguage").style.display = "none";

        // Mettre à jour les textes traduits
        document.querySelectorAll(".translate").forEach((el) => {
            const key = el.getAttribute("data-key");
            el.textContent = translations[lang][key] || translations["fr"][key];
        });

        // Mettre à jour le placeholder de recherche
        document.querySelector(".search-container input").placeholder =
            translations[lang]["search_placeholder"];
        document.getElementById("countrySearch").placeholder =
            translations[lang]["search_country"];

        // Sauvegarder la préférence
        localStorage.setItem("preferredLanguage", lang);
    }

    // Initialisation
    document.addEventListener("DOMContentLoaded", function() {
        // Récupérer la langue sauvegardée ou détecter la langue du navigateur
        const savedLanguage = localStorage.getItem("preferredLanguage");
        const browserLanguage = navigator.language.slice(0, 2);

        if (savedLanguage) {
            changeLanguage(savedLanguage);
        } else if (translations[browserLanguage]) {
            changeLanguage(browserLanguage);
        }

        // Gestion des menus déroulants
        const languageToggle = document.getElementById("languageToggle");
        const dropdownLanguage = document.getElementById("dropdownLanguage");

        languageToggle.addEventListener("click", (e) => {
            e.stopPropagation();
            dropdownLanguage.style.display =
                dropdownLanguage.style.display === "block" ? "none" : "block";
        });

        document.addEventListener("click", (e) => {
            if (!e.target.closest(".language-dropdown")) {
                dropdownLanguage.style.display = "none";
            }
        });

        // ... (le reste de votre code existant pour les pays) ...
    });

    // ... (le reste de votre code JavaScript existant) ...











    // Gestion du menu mobile
    document.addEventListener("DOMContentLoaded", function() {
        const mobileMenuToggle = document.querySelector(".mobile-menu-toggle");
        const mobileMenuModal = document.getElementById("mobileMenuModal");
        const closeMobileMenu = document.getElementById("closeMobileMenu");
        const mobileMenuBack = document.getElementById("mobileMenuBack");
        const mobileMainMenu = document.getElementById("mobileMainMenu");
        const helpMenu = document.getElementById("helpMenu");
        const regionMenu = document.getElementById("regionMenu");
        const menuSections = document.querySelectorAll(".mobile-menu-section");

        // Ouvrir/fermer le menu mobile
        if (mobileMenuToggle) {
            mobileMenuToggle.addEventListener("click", function() {
                mobileMenuModal.style.display = "block";
                document.body.style.overflow = "hidden";
            });
        }

        closeMobileMenu.addEventListener("click", function() {
            mobileMenuModal.style.display = "none";
            document.body.style.overflow = "";
        });

        // Navigation dans les sous-menus
        menuSections.forEach((section) => {
            section.addEventListener("click", function() {
                const target = this.getAttribute("data-target");
                document.getElementById(target).style.display = "block";
                mobileMainMenu.style.display = "none";
                mobileMenuBack.style.display = "block";
            });
        });

        // Bouton retour
        mobileMenuBack.addEventListener("click", function() {
            mobileMainMenu.style.display = "block";
            helpMenu.style.display = "none";
            regionMenu.style.display = "none";
            this.style.display = "none";
        });

        // Annuler les paramètres régionaux
        document
            .querySelector(".cancel-region")
            ?.addEventListener("click", function() {
                mobileMainMenu.style.display = "block";
                regionMenu.style.display = "none";
                mobileMenuBack.style.display = "none";
            });

        // Soumission des paramètres régionaux
        document
            .getElementById("mobileRegionForm")
            ?.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                const currency = formData.get("currency");
                const country = formData.get("country");
                const language = formData.get("language");

                // Sauvegarder les préférences
                localStorage.setItem(
                    "userSettings",
                    JSON.stringify({
                        currency: currency,
                        country: country,
                        language: language,
                    })
                );

                // Mettre à jour l'interface
                updateRegionalSettings(currency, country, language);

                // Revenir au menu principal
                mobileMainMenu.style.display = "block";
                regionMenu.style.display = "none";
                mobileMenuBack.style.display = "none";


            });
    });

    function updateRegionalSettings(currency, country, language) {
        // Mettre à jour les éléments de l'interface en fonction des nouveaux paramètres
        console.log("Paramètres mis à jour:", {
            currency,
            country,
            language
        });
        // Implémentez ici la logique pour mettre à jour votre interface
    }





    // Fonctions pour gérer le modal
    function openCountryModal() {
        document.getElementById("dropdownCountry").style.display =
            "block";
    }

    function closeCountryModal() {
        document.getElementById("dropdownCountry").style.display =
            "none";
    }

    // Fermer quand on clique sur ×
    document.querySelector(".close").onclick = closeCountryModal;

    // Fermer quand on clique sur Annuler
    document.querySelector(".cancel-btn").onclick = closeCountryModal;

    // Fermer quand on clique en dehors du modal
    window.onclick = function(event) {
        if (
            event.target == document.getElementById("dropdownCountry")
        ) {
            closeCountryModal();
        }
    };



    document.getElementById("chatBtn").addEventListener("click", () => {
        document.getElementById("chatModal").style.display = "flex";
    });

    document.getElementById("closeChat").addEventListener("click", () => {
        document.getElementById("chatModal").style.display = "none";
    });

    document.getElementById("sendBtn").addEventListener("click", () => {
        const input = document.getElementById("chatInput");
        const message = input.value.trim();
        if (message !== "") {
            const chatBody = document.getElementById("chatBody");

            // Message utilisateur
            const userMsg = document.createElement("div");
            userMsg.className = "chat-message user";
            userMsg.textContent = message;
            chatBody.appendChild(userMsg);

            // Réponse bot simulée
            const botMsg = document.createElement("div");
            botMsg.className = "chat-message bot";
            botMsg.textContent =
                "Merci pour votre message, nous vous répondrons bientôt !";
            chatBody.appendChild(botMsg);

            input.value = "";
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    });






    class ARMeasurementApp {
        constructor() {
            this.isActive = false;
            this.measurementPoints = [];
            this.measurements = [];
            this.pixelsPerMM = 2;
            this.videoStream = null;

            this.currentFacingMode = "environment"; // Commence par la caméra arrière
            this.availableCameras = [];

            this.initializeElements();
            this.bindEvents();
            this.detectAvailableCameras();
        }

        initializeElements() {
            this.elements = {
                arBtn: document.getElementById("arMeasureBtn"),
                arContainer: document.getElementById("arContainer"),
                video: document.getElementById("videoStream"),
                overlay: document.getElementById("arOverlay"),
                statusIndicator: document.getElementById("statusIndicator"),
                statusText: document.getElementById("statusText"),
                pointCount: document.getElementById("pointCount"),
                lastMeasurement: document.getElementById("lastMeasurement"),
                addPointBtn: document.getElementById("addPointBtn"),
                clearBtn: document.getElementById("clearBtn"),
                sendBtn: document.getElementById("sendMeasurementsBtn"),
                closeBtn: document.getElementById("closeArBtn"),
                switchCameraBtn: document.getElementById("switchCameraBtn"),
                // Nouveaux éléments pour le modal
                permissionModal: document.getElementById("cameraPermissionModal"),
                allowCameraBtn: document.getElementById("allowCameraBtn"),
                denyCameraBtn: document.getElementById("denyCameraBtn"),
                closePermissionModal: document.getElementById(
                    "closePermissionModal"
                ),
            };
        }

        bindEvents() {
            if (this.elements.arBtn) {
                this.elements.arBtn.addEventListener("click", () => this.startAR());
            }
            this.elements.closeBtn.addEventListener("click", () => this.stopAR());
            this.elements.addPointBtn.addEventListener("click", () =>
                this.addMeasurementPoint()
            );
            this.elements.clearBtn.addEventListener("click", () =>
                this.clearMeasurements()
            );
            this.elements.sendBtn.addEventListener("click", () =>
                this.sendMeasurements()
            );

            this.elements.overlay.addEventListener("click", (e) => {
                if (this.isActive) {
                    const rect = this.elements.overlay.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    this.addPointAtPosition(x, y);
                }
            });
        }

        async startAR() {
            try {
                this.showStatus("Demande d'autorisation caméra...");

                if (
                    !navigator.mediaDevices ||
                    !navigator.mediaDevices.getUserMedia
                ) {
                    throw new Error("getUserMedia non supporté par ce navigateur");
                }

                const stream = await navigator.mediaDevices
                    .getUserMedia({
                        video: {
                            facingMode: "environment",
                            width: {
                                ideal: 1920,
                                min: 640
                            },
                            height: {
                                ideal: 1080,
                                min: 480
                            },
                        },
                    })
                    .catch(async (error) => {
                        if (
                            error.name === "OverconstrainedError" ||
                            error.name === "NotFoundError"
                        ) {
                            return await navigator.mediaDevices.getUserMedia({
                                video: {
                                    facingMode: "user",
                                    width: {
                                        ideal: 1280,
                                        min: 640
                                    },
                                    height: {
                                        ideal: 720,
                                        min: 480
                                    },
                                },
                            });
                        }
                        throw error;
                    });

                this.videoStream = stream;
                this.elements.video.srcObject = stream;

                await new Promise((resolve, reject) => {
                    this.elements.video.onloadedmetadata = resolve;
                    this.elements.video.onerror = reject;
                    setTimeout(() => reject(new Error("Timeout")), 10000);
                });

                this.elements.arContainer.classList.remove("hidden");
                this.hideStatus();
                this.isActive = true;
                this.calibrateScale();
            } catch (error) {
                console.error("Erreur caméra:", error);
                this.handleCameraError(error);
            }
        }

        handleCameraError(error) {
            let message = "";
            switch (error.name) {
                case "NotAllowedError":
                    message = "🚫 Accès caméra refusé";
                    break;
                case "NotFoundError":
                    message = "📷 Aucune caméra trouvée";
                    break;
                default:
                    message = "❌ Erreur caméra";
            }
            this.showCameraPermissionDialog(message);
        }

        showCameraPermissionDialog(message) {
            const modal = document.createElement("div");
            modal.style.cssText = `
                    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
                    background: rgba(0,0,0,0.9); display: flex; align-items: center;
                    justify-content: center; z-index: 9999; padding: 20px;
                `;

            const isChrome = /Chrome/.test(navigator.userAgent);
            const isFirefox = /Firefox/.test(navigator.userAgent);
            const isMobile = /Mobi|Android/i.test(navigator.userAgent);

            let instructions = "";
            if (isChrome) {
                instructions =
                    "Cliquez sur l'icône 📷 dans la barre d'adresse et autorisez la caméra";
            } else if (isFirefox) {
                instructions = 'Cliquez sur "Autoriser" dans la popup de Firefox';
            } else {
                instructions =
                    "Autorisez l'accès à la caméra dans votre navigateur";
            }

            modal.innerHTML = `
                    <div style="background: white; padding: 30px; border-radius: 20px; max-width: 400px; text-align: center; color: #333;">
                        <div style="font-size: 60px; margin-bottom: 20px;">📷</div>
                        <h2 style="color: #ff4757; margin-bottom: 15px;">${message}</h2>
                        <p style="margin-bottom: 20px;">${instructions}</p>
                        <div style="background: #fff9c4; padding: 15px; border-radius: 8px; margin: 20px 0;">
                            <strong>⚠️ Important :</strong><br>
                            Vos images ne sont jamais enregistrées ni envoyées.
                        </div>
                        <div style="display: flex; gap: 15px; justify-content: center;">
                            <button onclick="window.location.reload()" style="padding: 15px 25px; background: #4a6bff; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                                🔄 Réessayer
                            </button>
                            <button onclick="this.parentElement.parentElement.remove()" style="padding: 15px 25px; background: #636e72; color: white; border: none; border-radius: 10px; cursor: pointer; font-weight: bold;">
                                ❌ Annuler
                            </button>
                        </div>
                    </div>
                `;

            document.body.appendChild(modal);
            this.hideStatus();
        }

        stopAR() {
            if (this.videoStream) {
                this.videoStream.getTracks().forEach((track) => track.stop());
                this.videoStream = null;
            }
            this.elements.arContainer.classList.add("hidden");
            this.isActive = false;
            this.clearMeasurements();
        }

        calibrateScale() {
            const screenWidth = window.screen.width;
            const videoWidth = this.elements.video.videoWidth;
            this.pixelsPerMM = (videoWidth / screenWidth) * 0.5;
        }

        addPointAtPosition(x, y) {
            const point = {
                id: Date.now(),
                x: x,
                y: y,
                timestamp: new Date()
            };
            this.measurementPoints.push(point);
            this.renderPoint(point);

            if (this.measurementPoints.length >= 2) {
                this.calculateAndRenderMeasurement();
            }
            this.updateUI();
        }

        addMeasurementPoint() {
            const centerX = this.elements.overlay.offsetWidth / 2;
            const centerY = this.elements.overlay.offsetHeight / 2;
            this.addPointAtPosition(centerX, centerY);
        }

        renderPoint(point) {
            const pointElement = document.createElement("div");
            pointElement.className = "measurement-point";
            pointElement.style.left = `${point.x}px`;
            pointElement.style.top = `${point.y}px`;
            this.elements.overlay.appendChild(pointElement);
        }

        calculateAndRenderMeasurement() {
            const points = this.measurementPoints;
            if (points.length < 2) return;

            const [point1, point2] = points.slice(-2);
            const pixelDistance = Math.sqrt(
                Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
            );
            const realDistance = pixelDistance / this.pixelsPerMM / 10;

            const measurement = {
                id: Date.now(),
                point1,
                point2,
                pixelDistance,
                realDistance,
                timestamp: new Date(),
            };

            this.measurements.push(measurement);
            this.renderMeasurementLine(measurement);
        }

        renderMeasurementLine(measurement) {
            const {
                point1,
                point2,
                realDistance
            } = measurement;

            const line = document.createElement("div");
            line.className = "measurement-line";

            const length = Math.sqrt(
                Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2)
            );
            const angle =
                (Math.atan2(point2.y - point1.y, point2.x - point1.x) * 180) /
                Math.PI;

            line.style.width = `${length}px`;
            line.style.left = `${point1.x}px`;
            line.style.top = `${point1.y}px`;
            line.style.transform = `rotate(${angle}deg)`;
            line.style.transformOrigin = "0 50%";

            const label = document.createElement("div");
            label.className = "measurement-label";

            let displayDistance =
                realDistance >= 100 ?
                `${(realDistance / 100).toFixed(2)} m` :
                `${realDistance.toFixed(1)} cm`;

            label.textContent = displayDistance;
            label.style.left = `${(point1.x + point2.x) / 2}px`;
            label.style.top = `${(point1.y + point2.y) / 2 - 30}px`;

            this.elements.overlay.appendChild(line);
            this.elements.overlay.appendChild(label);
            this.elements.lastMeasurement.textContent = displayDistance;
        }

        clearMeasurements() {
            this.measurementPoints = [];
            this.measurements = [];

            const measurementElements = this.elements.overlay.querySelectorAll(
                ".measurement-point, .measurement-line, .measurement-label"
            );
            measurementElements.forEach((el) => el.remove());
            this.updateUI();
        }

        updateUI() {
            this.elements.pointCount.textContent = this.measurementPoints.length;
            const totalMeasurementsEl =
                document.getElementById("totalMeasurements");
            if (totalMeasurementsEl) {
                totalMeasurementsEl.textContent = this.measurements.length;
            }

            const instructionEl = document.getElementById("instructionText");
            if (instructionEl) {
                if (this.measurementPoints.length === 0) {
                    instructionEl.innerHTML =
                        "📍 Cliquez sur le <strong>premier coin</strong> à mesurer";
                    instructionEl.style.color = "#4a6bff";
                } else if (this.measurementPoints.length === 1) {
                    instructionEl.innerHTML =
                        "📍 Maintenant cliquez sur le <strong>second coin</strong>";
                    instructionEl.style.color = "#ff4757";
                } else {
                    instructionEl.innerHTML =
                        "✅ Mesure terminée ! Vous pouvez en ajouter d'autres";
                    instructionEl.style.color = "#2ed573";
                }
            }
        }

        async sendMeasurements() {
            if (this.measurements.length === 0) {
                alert("Aucune mesure à envoyer. Ajoutez au moins 2 points.");
                return;
            }

            this.showStatus("📤 Envoi des mesures...");

            const data = {
                timestamp: new Date().toISOString(),
                measurements: this.measurements.map((m) => ({
                    realDistance: m.realDistance,
                    pixelDistance: m.pixelDistance,
                    timestamp: m.timestamp,
                })),
                summary: {
                    totalMeasurements: this.measurements.length,
                    averageDistance: this.measurements.reduce((sum, m) => sum + m.realDistance, 0) /
                        this.measurements.length,
                },
            };

            try {
                console.log("📊 Données de mesure:", data);

                // REMPLACEZ PAR VOTRE API :
                // const response = await fetch('/api/measurements', {
                //     method: 'POST',
                //     headers: { 'Content-Type': 'application/json' },
                //     body: JSON.stringify(data)
                // });

                await new Promise((resolve) => setTimeout(resolve, 1500));

                this.showStatus("✅ Mesures envoyées avec succès!");
                setTimeout(() => this.hideStatus(), 2000);
            } catch (error) {
                console.error("Erreur envoi:", error);
                this.showStatus("❌ Erreur lors de l'envoi");
                setTimeout(() => this.hideStatus(), 3000);
            }
        }

        showStatus(message) {
            this.elements.statusText.textContent = message;
            this.elements.statusIndicator.classList.remove("hidden");
        }

        hideStatus() {
            this.elements.statusIndicator.classList.add("hidden");
        }
    }

    // Initialisation quand le DOM est prêt
    document.addEventListener("DOMContentLoaded", () => {
        new ARMeasurementApp();
    });



    // Gestion des likes
    document.querySelectorAll(".like-btn").forEach((btn) => {
        btn.addEventListener("click", function() {
            this.classList.toggle("liked");
            const icon = this.querySelector("i");
            if (this.classList.contains("liked")) {
                icon.classList.remove("far");
                icon.classList.add("fas");
            } else {
                icon.classList.remove("fas");
                icon.classList.add("far");
            }
        });
    });


    // Appliquer un coupon
    document
        .getElementById("apply-coupon")
        .addEventListener("click", function() {
            const couponCode = document.getElementById("coupon").value;

            if (couponCode.toUpperCase() === "KELU15") {
                const subtotalText = subtotalElement.textContent;
                const subtotal = parseFloat(subtotalText.replace("€", ""));
                const discount = subtotal * 0.15;
                const total = subtotal - discount;

                // Ajouter la réduction au résumé
                const discountElement = document.createElement("div");
                discountElement.className = "summary-item";
                discountElement.innerHTML = `
                            <span>Réduction (15%)</span>
                            <span>-€${discount.toFixed(2)}</span>
                        `;

                // Vérifier si la réduction est déjà affichée
                if (!document.getElementById("discount-element")) {
                    discountElement.id = "discount-element";
                    cartItemsContainer.appendChild(discountElement);
                } else {
                    document.getElementById("discount-element").innerHTML =
                        discountElement.innerHTML;
                }

                totalElement.textContent = `€${total.toFixed(2)}`;
                alert("Code promo appliqué avec succès!");
            } else {
                alert("Code promo invalide");
            }
        });

    // Passer à la livraison
    document
        .getElementById("proceed-to-checkout")
        .addEventListener("click", function() {
            alert("Fonctionnalité de paiement à implémenter");
            // Ici, vous pourriez ajouter la logique pour passer à l'étape suivante du checkout
        });

    // Gestion des boutons flottants
    document
        .querySelector(".floating-buttons button:nth-child(1)")
        .addEventListener("click", function() {
            alert(
                "Fonctionnalité de partage sur les réseaux sociaux à implémenter"
            );
        });

    document
        .querySelector(".floating-buttons button:nth-child(2)")
        .addEventListener("click", function() {
            alert("Fonctionnalité de cagnotte commune à implémenter");
        });

    // Redirection vers la page de détails au clic sur l'image du produit
    document.querySelectorAll(".product-img").forEach((img, index) => {
        img.style.cursor = "pointer";
        img.addEventListener("click", function() {
            // Liste des IDs des produits dans le même ordre qu'ils apparaissent sur la page
            const productIds = ["1", "2", "3",
                "4"
            ]; // Correspond aux data-id des boutons "Ajouter au panier"

            // Récupérer l'ID du produit correspondant
            const productId = productIds[index];

            // Rediriger vers la page de détails avec l'ID en paramètre
            window.location.href = `product-details.html?id=${productId}`;
        });
    });


    // Navigation entre les étapes
    document
        .getElementById("proceed-to-delivery")
        .addEventListener("click", function() {
            document.getElementById("checkout-modal").style.display = "none";
            document.getElementById("delivery-modal").style.display = "block";
        });

    document
        .getElementById("proceed-to-payment")
        .addEventListener("click", function() {
            document.getElementById("delivery-modal").style.display = "none";
            document.getElementById("payment-modal").style.display = "block";
        });

    document
        .getElementById("confirm-order")
        .addEventListener("click", function() {
            document.getElementById("payment-modal").style.display = "none";
            document.getElementById("confirmation-modal").style.display = "block";
        });

    // Boutons de retour
    document
        .getElementById("back-to-cart")
        .addEventListener("click", function() {
            document.getElementById("delivery-modal").style.display = "none";
            document.getElementById("checkout-modal").style.display = "block";
        });

    document
        .getElementById("back-to-delivery")
        .addEventListener("click", function() {
            document.getElementById("payment-modal").style.display = "none";
            document.getElementById("delivery-modal").style.display = "block";
        });

    document
        .getElementById("return-to-shop")
        .addEventListener("click", function() {
            document.getElementById("confirmation-modal").style.display = "none";
            // Redirection vers la page d'accueil
            window.location.href = "/";
        });

    // Fermeture des modals
    document.querySelectorAll(".close-modal").forEach(function(btn) {
        btn.addEventListener("click", function() {
            this.closest(".modal").style.display = "none";
        });
    });

    // Ouverture du modal panier (exemple)
    function openCartModal() {
        document.getElementById("checkout-modal").style.display = "block";
    }
</script>
