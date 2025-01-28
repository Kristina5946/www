<!-- Форма поддержки -->
<section class="order-form-section">
    <form class="order-form mx-auto" style="max-width: 600px;" id="feedbackForm">
        <h4>Свяжитесь с нами</h4>
        <div class="row g-3">
            <!-- Первая строка: Имя и Телефон -->
            <div class="col-md-6">
                <label for="feedback-name" class="form-label">Ваше имя</label>
                <input type="text" class="form-control" id="feedback-name" name="name" required>
                <div class="invalid-feedback">Пожалуйста, заполните поле имени.</div>
            </div>
            <div class="col-md-6">
                <label for="feedback-phone" class="form-label">Ваш телефон</label>
                <input type="tel" class="form-control" id="feedback-phone" name="phone" required>
                <div class="invalid-feedback">Пожалуйста, заполните поле телефона.</div>
            </div>
            <!-- Вторая строка: Email и Сообщение -->
            <div class="col-md-6">
                <label for="feedback-email" class="form-label">Ваш Email</label>
                <input type="email" class="form-control" id="feedback-email" name="email" required>
                <div class="invalid-feedback">Пожалуйста, введите действительный Email.</div>
            </div>
            <div class="col-md-6">
                <label for="feedback-message" class="form-label">Сообщение</label>
                <textarea class="form-control" id="feedback-message" name="question" rows="1" required></textarea>
                <div class="invalid-feedback">Пожалуйста, заполните поле сообщения.</div>
            </div>
        </div>
        <!-- Чекбокс согласия -->
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
                Я прочитал(а) и соглашаюсь с <a href="#" id="termsLink">правилами и условиями</a>
            </label>
        </div>
        <!-- Кнопка отправки -->
        <div class="text-center mt-4">
            <button type="submit" class="btn order-btn" id="submitFeedback" disabled>Связаться</button>
        </div>
        <!-- Модальное окно для правил -->
        <div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="termsModalLabel">Правила и условия</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        Здесь будет текст правил и условий...
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
</section>

<!-- Добавление иконки ватсапа для свзи изменить номер!!!!! -->
<a href="https://wa.me/89880054918" class="whatsapp-icon" target="_blank">
    <img src="image/whatsapp-icon.png" alt="WhatsApp" />
</a>

<style>
    .whatsapp-icon {
        position: fixed;
        bottom: 20px;
        left: 20px;
        z-index: 1000;
    }

    .whatsapp-icon img {
        width: 60px; /* Настройте размер иконки */
    }
</style>
<script>
    // Обработчик для чекбокса "Согласие с условиями"
    document.getElementById('terms').addEventListener('change', function(event) {
        const submitButton = document.querySelector('#submitFeedback');
        submitButton.disabled = !event.target.checked;
    });

    document.getElementById('termsLink').addEventListener('click', function(event) {
        event.preventDefault();
        const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
        termsModal.show();
    });

    document.querySelector('#submitFeedback').addEventListener('click', (event) => {
        event.preventDefault();

        const name = document.getElementById('feedback-name').value.trim();
        const phone = document.getElementById('feedback-phone').value.trim();
        const email = document.getElementById('feedback-email').value.trim();
        const message = document.getElementById('feedback-message').value.trim();

        if (!name || !phone || !email || !message) {
            if (!name) document.getElementById('feedback-name').classList.add('is-invalid');
            if (!phone) document.getElementById('feedback-phone').classList.add('is-invalid');
            if (!email) document.getElementById('feedback-email').classList.add('is-invalid');
            if (!message) document.getElementById('feedback-message').classList.add('is-invalid');
            return;
        }

        fetch('submit_feedback.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ name, phone, email, question: message }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert('Ошибка: ' + data.error);
                } else {
                    alert('Спасибо за ваше сообщение!');
                    document.getElementById('feedbackForm').reset();
                }
            })
            .catch(error => {
                console.error('Ошибка:', error);
                alert('Произошла ошибка. Пожалуйста, попробуйте позже.');
            });
    });


</script>