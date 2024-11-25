document.addEventListener('DOMContentLoaded', () => {
    console.log('Página carregada com sucesso!');

    const app = {
        btnReserva: document.querySelector('.btn-reserva'),
        scrollThreshold: 100,

        // Função para rolagem suave
        smoothScroll(event) {
            event.preventDefault();
            const targetId = event.currentTarget.getAttribute('href');
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({ behavior: 'smooth' });
            }
        },

        // Alterna a visibilidade do botão de reserva
        toggleReservaButtonVisibility(isVisible) {
            if (this.btnReserva) {
                this.btnReserva.classList.toggle('visible', isVisible);
                this.btnReserva.classList.toggle('hidden', !isVisible);
            }
        },

        // Configura o IntersectionObserver para verificar a visibilidade do botão de reserva
        observeReservaButtonVisibility() {
            if (!this.btnReserva) return;

            const observerOptions = {
                root: null, // viewport
                rootMargin: '0px',
                threshold: 0.1 // O botão deve estar 10% visível para ser considerado visível
            };

            const handleIntersection = (entries) => {
                entries.forEach(entry => {
                    // Verifica se o botão está visível no viewport
                    this.toggleReservaButtonVisibility(entry.isIntersecting);
                });
            };

            const observer = new IntersectionObserver(handleIntersection, observerOptions);
            observer.observe(this.btnReserva);
        },

        // Adiciona todos os ouvintes de eventos
        addEventListeners() {
            // Para rolagem suave nos links do menu
            document.querySelectorAll('nav ul li a').forEach(anchor => {
                anchor.addEventListener('click', this.smoothScroll);
            });
        },

        // Inicializa o aplicativo
        init() {
            if (this.btnReserva) {
                this.observeReservaButtonVisibility();
            } else {
                console.warn('Botão de reserva não encontrado!');
            }

            this.addEventListeners();
        }
    };

    // Inicializa o aplicativo
    app.init();
});
bndsjkbvjbsdmvbmcxnbvmnbmncxbnmvb