const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');

function initMobileNavigation() {
    document.querySelectorAll('[data-nav-toggle]').forEach((toggle) => {
        const target = document.getElementById(toggle.getAttribute('aria-controls'));

        if (!target) {
            return;
        }

        toggle.addEventListener('click', () => {
            const open = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!open));
            target.classList.toggle('hidden', open);
            document.body.classList.toggle('overflow-hidden', !open);
        });

        target.querySelectorAll('a').forEach((link) => {
            link.addEventListener('click', () => {
                toggle.setAttribute('aria-expanded', 'false');
                target.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            });
        });
    });
}

function initReveals() {
    const elements = document.querySelectorAll('.reveal');

    if (!elements.length) {
        return;
    }

    if (reduceMotion.matches || !('IntersectionObserver' in window)) {
        elements.forEach((element) => element.classList.add('is-visible'));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    observer.unobserve(entry.target);
                }
            });
        },
        { rootMargin: '0px 0px -8% 0px', threshold: 0.08 },
    );

    elements.forEach((element) => observer.observe(element));
}

function initProjectFilters() {
    document.querySelectorAll('[data-project-filters]').forEach((filterBar) => {
        const buttons = filterBar.querySelectorAll('[data-filter]');
        const rows = document.querySelectorAll('[data-project-row]');
        const empty = document.querySelector('[data-filter-empty]');

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                const filter = button.dataset.filter;
                let visible = 0;

                buttons.forEach((item) => {
                    item.setAttribute('aria-pressed', String(item === button));
                });

                rows.forEach((row) => {
                    const categories = (row.dataset.category || '').split('|');
                    const show = filter === 'all' || categories.includes(filter);
                    row.hidden = !show;

                    if (show) {
                        visible += 1;
                    }
                });

                if (empty) {
                    empty.hidden = visible !== 0;
                }
            });
        });
    });
}

function initContactForm() {
    document.querySelectorAll('[data-contact-form]').forEach((form) => {
        const submit = form.querySelector('[data-submit]');
        const label = submit?.querySelector('[data-submit-label]');

        if (!submit || !label) {
            return;
        }

        form.addEventListener('submit', () => {
            submit.disabled = true;
            submit.classList.add('opacity-70', 'cursor-wait');
            label.textContent = 'Mengirim…';
        });
    });
}

function initConfirmDialogs() {
    document.querySelectorAll('[data-confirm-form]').forEach((form) => {
        const dialog = document.getElementById(form.dataset.confirmForm);

        if (!dialog) {
            return;
        }

        form.addEventListener('submit', (event) => {
            if (form.dataset.confirmed === 'true') {
                return;
            }

            event.preventDefault();
            const trigger = event.submitter;

            dialog.querySelector('[data-confirm-action]')?.addEventListener(
                'click',
                () => {
                    form.dataset.confirmed = 'true';
                    form.requestSubmit(trigger);
                },
                { once: true },
            );

            if (typeof dialog.showModal === 'function') {
                dialog.showModal();
            } else if (window.confirm(dialog.dataset.message || 'Lanjutkan?')) {
                form.dataset.confirmed = 'true';
                form.requestSubmit(trigger);
            }
        });
    });
}

function initCopyButtons() {
    document.querySelectorAll('[data-copy]').forEach((button) => {
        button.addEventListener('click', async () => {
            const value = button.dataset.copy;
            const original = button.textContent;

            try {
                await navigator.clipboard.writeText(value);
                button.textContent = 'Tersalin';
                window.setTimeout(() => {
                    button.textContent = original;
                }, 1600);
            } catch {
                button.textContent = 'Gagal menyalin';
            }
        });
    });
}

function initDiagramReplay() {
    document.querySelectorAll('[data-replay-diagram]').forEach((button) => {
        button.addEventListener('click', () => {
            const svg = document.querySelector(button.dataset.replayDiagram);

            if (!svg) {
                return;
            }

            const animated = svg.querySelectorAll('.diagram-line');

            animated.forEach((element) => {
                element.style.animation = 'none';
            });

            void svg.getBoundingClientRect();

            animated.forEach((element) => {
                element.style.animation = '';
            });
        });
    });
}

function initImagePreviews() {
    document.querySelectorAll('[data-image-input]').forEach((input) => {
        const preview = document.querySelector(input.dataset.imageInput);

        if (!preview) {
            return;
        }

        input.addEventListener('change', () => {
            const file = input.files?.[0];

            if (!file || !file.type.startsWith('image/')) {
                return;
            }

            const reader = new FileReader();
            reader.addEventListener('load', () => {
                preview.src = String(reader.result);
                preview.hidden = false;
                preview.parentElement?.querySelector('[data-preview-empty]')?.setAttribute('hidden', 'hidden');
            });
            reader.readAsDataURL(file);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    initMobileNavigation();
    initReveals();
    initProjectFilters();
    initContactForm();
    initConfirmDialogs();
    initCopyButtons();
    initImagePreviews();
    initDiagramReplay();
});
