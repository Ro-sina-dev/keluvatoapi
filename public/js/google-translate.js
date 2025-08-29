/**
 * Keluvato Site Translator - Simple and Effective
 * Translates entire site content when language is changed
 */

class KeluvateTranslator {
    constructor() {
        this.currentLanguage = localStorage.getItem('preferredLanguage') || 'fr';
        this.originalTexts = new Map(); // Store original texts
        this.isTranslating = false;
        this.init();
    }

    init() {
        // Store original texts on first load
        this.storeOriginalTexts();
        
        // Override existing changeLanguage functions
        this.overrideLanguageFunctions();
        
        // Apply saved language on page load
        if (this.currentLanguage !== 'fr') {
            setTimeout(() => this.translatePage(this.currentLanguage), 500);
        }
    }

    storeOriginalTexts() {
        // Store original French texts for later restoration
        const elements = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, a, button, label, li, td, th, .translate, [data-translate]');
        elements.forEach((el, index) => {
            if (el.children.length === 0 && el.textContent.trim()) {
                this.originalTexts.set(`element_${index}`, {
                    element: el,
                    originalText: el.textContent.trim()
                });
            }
        });

        // Store placeholders
        const inputs = document.querySelectorAll('input[placeholder], textarea[placeholder]');
        inputs.forEach((el, index) => {
            this.originalTexts.set(`placeholder_${index}`, {
                element: el,
                originalText: el.getAttribute('placeholder')
            });
        });
    }

    overrideLanguageFunctions() {
        // Override global changeLanguage function
        window.changeLanguage = (lang) => {
            this.changeLanguage(lang);
        };
    }

    changeLanguage(lang) {
        if (this.isTranslating) return;
        
        console.log('Changing language to:', lang);
        this.currentLanguage = lang;
        this.isTranslating = true;

        // Update language code display
        document.querySelectorAll(".language-code").forEach((el) => {
            el.textContent = lang.toUpperCase();
        });

        // Hide language dropdown
        const dropdown = document.getElementById("dropdownLanguage");
        if (dropdown) dropdown.style.display = "none";

        // Save preference
        localStorage.setItem("preferredLanguage", lang);

        // Translate page
        this.translatePage(lang);

        setTimeout(() => {
            this.isTranslating = false;
        }, 3000);
    }

    async translatePage(targetLang) {
        if (targetLang === 'fr') {
            this.resetToOriginal();
            return;
        }

        console.log('Translating page to:', targetLang);

        // Show loading indicator
        this.showLoadingIndicator();

        // Translate all stored elements
        const promises = [];
        this.originalTexts.forEach((data, key) => {
            if (key.startsWith('element_')) {
                promises.push(this.translateElement(data, targetLang));
            } else if (key.startsWith('placeholder_')) {
                promises.push(this.translatePlaceholder(data, targetLang));
            }
        });

        await Promise.all(promises);
        this.hideLoadingIndicator();
        console.log('Translation completed');
    }

    async translateElement(data, targetLang) {
        const { element, originalText } = data;
        
        if (!originalText || this.isNumericOrSymbol(originalText)) return;

        try {
            const translatedText = await this.translateText(originalText, targetLang);
            if (translatedText && translatedText !== originalText) {
                element.textContent = translatedText;
            }
        } catch (e) {
            console.warn('Translation failed for:', originalText);
        }
    }

    async translatePlaceholder(data, targetLang) {
        const { element, originalText } = data;
        
        if (!originalText || this.isNumericOrSymbol(originalText)) return;

        try {
            const translatedText = await this.translateText(originalText, targetLang);
            if (translatedText && translatedText !== originalText) {
                element.setAttribute('placeholder', translatedText);
            }
        } catch (e) {
            console.warn('Placeholder translation failed for:', originalText);
        }
    }

    async translateText(text, targetLang) {
        // Clean text
        const cleanText = text.replace(/\s+/g, ' ').trim();
        if (cleanText.length < 2) return null;

        try {
            // Use MyMemory API (free)
            const response = await fetch(`https://api.mymemory.translated.net/get?q=${encodeURIComponent(cleanText)}&langpair=fr|${targetLang}`);
            const data = await response.json();
            
            if (data.responseStatus === 200 && data.responseData.translatedText) {
                return data.responseData.translatedText;
            }
        } catch (e) {
            console.warn('Translation API failed:', e);
        }

        // Fallback: try LibreTranslate (if available)
        try {
            const response = await fetch('https://libretranslate.de/translate', {
                method: 'POST',
                body: JSON.stringify({
                    q: cleanText,
                    source: 'fr',
                    target: targetLang,
                    format: 'text'
                }),
                headers: { 'Content-Type': 'application/json' }
            });
            
            const data = await response.json();
            if (data.translatedText) {
                return data.translatedText;
            }
        } catch (e) {
            console.warn('LibreTranslate failed:', e);
        }
        
        return null;
    }

    isNumericOrSymbol(text) {
        // Check if text is purely numeric, currency, or symbols
        return /^[\d\s€$£¥.,%-]+$/.test(text) || 
               text.length < 2 || 
               /^[0-9\s.,€$£¥%-]+$/.test(text) ||
               text.includes('€') ||
               text.includes('$') ||
               /^\d/.test(text);
    }

    resetToOriginal() {
        console.log('Resetting to original French');
        
        // Restore all original texts
        this.originalTexts.forEach((data, key) => {
            const { element, originalText } = data;
            
            if (key.startsWith('element_')) {
                element.textContent = originalText;
            } else if (key.startsWith('placeholder_')) {
                element.setAttribute('placeholder', originalText);
            }
        });
    }

    showLoadingIndicator() {
        // Create or show loading indicator
        let loader = document.getElementById('translation-loader');
        if (!loader) {
            loader = document.createElement('div');
            loader.id = 'translation-loader';
            loader.innerHTML = `
                <div style="position: fixed; top: 20px; right: 20px; background: #007bff; color: white; padding: 10px 15px; border-radius: 5px; z-index: 9999; font-size: 14px;">
                    <i class="fas fa-spinner fa-spin"></i> Traduction en cours...
                </div>
            `;
            document.body.appendChild(loader);
        }
        loader.style.display = 'block';
    }

    hideLoadingIndicator() {
        const loader = document.getElementById('translation-loader');
        if (loader) {
            loader.style.display = 'none';
        }
    }
}

// Initialize translator when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    console.log('Initializing Keluvate Translator');
    window.keluvateTranslator = new KeluvateTranslator();
});

// Expose for manual usage
window.KeluvateTranslator = KeluvateTranslator;
