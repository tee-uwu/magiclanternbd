
<div class="sidebar-theme-toggle" style="display: flex; justify-content: center; margin: 12px 0; padding: 6px 0;">
    <button class="premium-theme-toggle" title="Toggle Dark/Light Mode" aria-label="Toggle theme">
        <span class="mode-label left">Light</span>
        <div class="toggle-knob"></div>
        <span class="mode-label right">Dark</span>
    </button>
</div>

<style>
.premium-theme-toggle {
    --toggle-width: 100px;
    --toggle-height: 34px;
    --knob-size: 30px;
    --knob-translate: 52px;
    --border-radius: 17px;
    --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    
    position: relative;
    width: var(--toggle-width);
    height: var(--toggle-height);
    border: 1px solid rgba(0,0,0,0.1);
    border-radius: var(--border-radius);
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(25px);
    cursor: pointer;
    display: flex;
    align-items: center;
    padding: 0 16px;
    gap: 8px;
    box-shadow: 
        0 6px 24px rgba(0,0,0,0.12),
        inset 0 1px 0 rgba(255,255,255,0.8);
    transition: var(--transition);
    overflow: hidden;
    font-weight: 600;
    font-size: 11px;
    letter-spacing: 0.3px;
    text-transform: uppercase;
    color: #374151;
}

.dark .premium-theme-toggle {
    background: rgba(31,41,55,0.95);
    border-color: rgba(255,255,255,0.2);
    color: #f9fafb;
    box-shadow: 
        0 6px 24px rgba(0,0,0,0.4),
        inset 0 1px 0 rgba(255,255,255,0.2);
}

.premium-theme-toggle:hover { 
    transform: translateY(-1px); 
    box-shadow: 
        0 12px 36px rgba(0,0,0,0.18),
        inset 0 1px 0 rgba(255,255,255,0.9);
}

.premium-theme-toggle:hover.dark {
    box-shadow: 
        0 12px 36px rgba(0,0,0,0.45),
        inset 0 1px 0 rgba(255,255,255,0.3);
}

.premium-theme-toggle.active { 
    background: linear-gradient(135deg, rgba(59,130,246,0.15), rgba(99,102,241,0.15)); 
    border-color: rgba(59,130,246,0.4);
    color: #1f2937;
}

.dark .premium-theme-toggle.active { 
    background: linear-gradient(135deg, rgba(251,191,36,0.25), rgba(245,158,11,0.2)); 
    border-color: rgba(251,191,36,0.6);
    color: #ffffff;
}

.premium-theme-toggle .mode-label {
    position: relative;
    z-index: 2;
    opacity: 0.8;
    transition: var(--transition);
    flex-shrink: 0;
}

.premium-theme-toggle .left { color: #3b82f6; }
.premium-theme-toggle .right { color: #f59e0b; }

.premium-theme-toggle.active .left { opacity: 0.4; }
.premium-theme-toggle.active .right { opacity: 1; font-weight: 700; }

.toggle-knob {
    position: absolute;
    left: 3px;
    width: var(--knob-size);
    height: var(--knob-size);
    border-radius: 50%;
    background: linear-gradient(145deg, #ffffff, #f8fafc);
    box-shadow: 
        0 8px 24px rgba(0,0,0,0.15),
        inset 0 1px 0 rgba(255,255,255,0.9),
        0 0 0 1px rgba(255,255,255,1);
    transition: var(--transition);
    z-index: 3;
    backdrop-filter: blur(12px);
}

.dark .toggle-knob {
    background: linear-gradient(145deg, #374151, #1f2937);
    box-shadow: 
        0 8px 24px rgba(0,0,0,0.4),
        inset 0 1px 0 rgba(255,255,255,0.2),
        0 0 0 1px rgba(255,255,255,0.4);
}

.premium-theme-toggle.active .toggle-knob {
    left: calc(3px + var(--knob-translate));
    background: linear-gradient(145deg, #3b82f6, #1d4ed8);
    box-shadow: 
        0 8px 28px rgba(59,130,246,0.4),
        inset 0 1px 0 rgba(255,255,255,0.8),
        0 0 0 1px rgba(255,255,255,1);
}

.dark .premium-theme-toggle.active .toggle-knob {
    background: linear-gradient(145deg, #f59e0b, #d97706);
    box-shadow: 
        0 8px 28px rgba(245,158,11,0.5),
        inset 0 1px 0 rgba(255,255,255,0.6),
        0 0 0 1px rgba(255,255,255,0.8);
}

@media (max-width: 768px) { 
    .premium-theme-toggle { 
        --toggle-width: 90px;
        --toggle-height: 32px;
        --knob-size: 28px;
        font-size: 10px;
        padding: 0 14px;
        gap: 6px;
    }
}
</style>

<script>
(function() {
    let initDone = false;
    
    function initThemeToggle() {
        if (initDone) return;
        initDone = true;
        
        const toggles = document.querySelectorAll('.sidebar-theme-toggle .premium-theme-toggle');
        const html = document.documentElement;
        
        // PRIORITY: localStorage first, then system
        let saved = localStorage.getItem('filament-theme');
        if (!saved) {
            saved = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            localStorage.setItem('filament-theme', saved);
        }
        
        const isDark = saved === 'dark';
        
        html.classList.toggle('dark', isDark);
        toggles.forEach(toggle => toggle.classList.toggle('active', isDark));
        
        console.log('✅ Theme toggle ready:', saved);
        
        toggles.forEach(toggle => {
            // Remove existing listeners
            toggle.replaceWith(toggle.cloneNode(true));
            const newToggle = document.querySelector('.sidebar-theme-toggle .premium-theme-toggle');
            
            newToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const newIsDark = !html.classList.contains('dark');
                html.classList.toggle('dark');
                newToggle.classList.toggle('active');
                localStorage.setItem('filament-theme', newIsDark ? 'dark' : 'light');
                
                console.log('🔄 Toggled:', newIsDark ? 'dark' : 'light');
                
                if (window.Livewire?.dispatch) {
                    Livewire.dispatch('theme-changed', [{ dark: newIsDark }]);
                }
            });
        });
        
        // Strict sync observer
        const observer = new MutationObserver((mutations) => {
            const currentDark = html.classList.contains('dark');
            const savedDark = localStorage.getItem('filament-theme') === 'dark';
            if (currentDark !== savedDark) {
                html.classList.toggle('dark', savedDark);
                document.querySelectorAll('.sidebar-theme-toggle .premium-theme-toggle').forEach(toggle => {
                    toggle.classList.toggle('active', savedDark);
                });
            }
        });
        observer.observe(html, { attributes: true, attributeFilter: ['class'] });
    }
    
    // Robust init hooks
    const events = ['DOMContentLoaded', 'livewire:load', 'livewire:navigated', 'alpine:init'];
    events.forEach(event => document.addEventListener(event, initThemeToggle, { once: true }));
    
    window.addEventListener('beforeunload', () => {
        localStorage.setItem('filament-theme', document.documentElement.classList.contains('dark') ? 'dark' : 'light');
    });
})();
</script>

