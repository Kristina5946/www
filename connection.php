<!-- Форма поддержки -->
<section class="order-form-section">
    <form class="order-form mx-auto" style="max-width: 600px;" id="feedbackForm">
        <h4>Свяжитесь с нами</h4>
        <div class="row g-3">
            <div class="col-md-6">
                <input type="text" class="form-control" id="name" placeholder="Имя" required>
            </div>
            <div class="col-md-6">
                <input type="tel" class="form-control" id="phone" placeholder="Телефон" required>
            </div>
            <div class="col-md-6">
                <input type="email" class="form-control" id="email" placeholder="Email" required>
            </div>
            <div class="col-md-6">
                <textarea class="form-control" id="question" rows="3" placeholder="Опишите ваш вопрос..." required></textarea>
            </div>
        </div>
        <div class="form-check mt-3">
            <input class="form-check-input" type="checkbox" id="terms" required>
            <label class="form-check-label" for="terms">
                Я прочитал(а) и соглашаюсь с <a href="#" id="termsLink">правилами и условиями</a>
            </label>
        </div>
        <div class="text-center mt-4">
            <button type="submit" class="btn order-btn" disabled>Связаться</button>
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
        const submitButton = document.querySelector('.order-btn');
        submitButton.disabled = !event.target.checked; // Активируем кнопку если чекбокс выбран
    });

    // Обработчик для ссылки "правила и условия"
    document.getElementById('termsLink').addEventListener('click', function(event) {
        event.preventDefault(); // Отменяем стандартное действие ссылки
        const termsModal = new bootstrap.Modal(document.getElementById('termsModal'));
        termsModal.show();
    });

    // Обработчик для отправки формы
    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Отменяем стандартное действие формы

        const name = document.getElementById('name').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const email = document.getElementById('email').value.trim();
        const question = document.getElementById('question').value.trim();

        // Вывод значений полей в консоль для отладки
        console.log('Name:', name);
        console.log('Phone:', phone);
        console.log('Email:', email);
        console.log('Question:', question);

        if (!name || !phone || !email || !question) {
            alert('Пожалуйста, заполните все поля.');
            return;
        }
        
        // Отправляем данные на сервер
        fetch('submit_feedback.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                name: name,
                phone: phone,
                email: email,
                question: question,
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Ошибка сети: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            if (data.error) {
                alert('Ошибка: ' + data.error);
            } else {
                alert(data.message); // Показываем сообщение об успешной отправке
                document.getElementById('feedbackForm').reset(); // Очищает поля формы
                document.querySelector('.order-btn').disabled = true; // Деактивируем кнопку
            }
        })
        .catch(error => {
            console.error('Ошибка:', error);
            alert('Произошла ошибка при отправке сообщения. Пожалуйста, попробуйте еще раз.');
        });
    });
</script>