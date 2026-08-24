<div id="fls-preloader">
    <script>
        function preloader() {
            const html = document.documentElement;

            // Если пользователь уже видел прелоадер
            if (localStorage.getItem('fls-preloader-viewed') === 'true') {
                html.classList.add('preloader-done'); // Сразу показываем контент страницы
                document.getElementById('fls-preloader')?.remove(); // Удаляем сам прелоадер
                return;
            }

            if (html.classList.contains('preloader-done')) {
                document.querySelector('.fls-preloader')?.remove();
                return;
            }

            html.classList.add('preloader-active');

            const style = document.createElement('style');
            style.textContent = `
		.fls-preloader {
			position: fixed;
			top: 0;
			left: 0;
			width: 100vw;
			height: 100vh;
			z-index: 999999;
			display: flex;
			justify-content: center;
			align-items: center;
			opacity: 0;
			pointer-events: none;
			transition: opacity 0.4s ease;
		}
		.fls-preloader.visible {
			opacity: 1;
			pointer-events: auto;
		}
		.fls-preloader__body {
			position: absolute;
			bottom: 200px;
			display: flex;
			flex-direction: column;
			align-items: center;
			top: 20%;
			opacity: 0;
			transition: opacity 0.8s ease 0.2s;
		}
		.fls-preloader__body.visible {
			opacity: 1;
		}
		.fls-preloader-image img {
			width: 333px;
			opacity: 0;
			animation: fadeSlideIn 1s ease forwards;
			margin-top: 20px;
		}
		@keyframes fadeSlideIn {
			from { opacity: 0; transform: translateY(20px); }
			to { opacity: 1; transform: translateY(0); }
			}
			.fls-preloader__counter {
				margin-top: 10px;
				color: #0C338C;
				font-family: "Montserrat-Medium", sans-serif;
				font-size: 40px;
				font-weight: 700;
				line-height: 46px;
				text-transform: uppercase;
				min-height: 46px;
			}
			.fls-preloader__line {
				width: 100%;
				max-width: 430px;
				height: 0.8rem;
				border-radius: 20px;
				background-color: #D6D9DD;
				overflow: hidden;
				margin-top: 20px;
			}
			.fls-preloader__line span {
				display: block;
				height: 100%;
				width: 0%;
				border-radius: 20px;
				background: #0C338C;
				transition: width 0.03s linear;
			}
			@media(max-width: 425px) {
				.fls-preloader-image img {
					width: 100%;
				}
					.fls-preloader__body {
					padding: 0 15px;

					}
			}
		`;
            document.head.appendChild(style);

            const preloaderEl = document.createElement('div');
            preloaderEl.className = 'fls-preloader';
            preloaderEl.innerHTML = `
			<div class="fls-preloader__body">
				<div class="fls-preloader-image">
					<img src="/local/templates/new_ucp/assets/img/icons/logoPreloader.svg" alt="Loading">
				</div>
				<div class="fls-preloader__line"><span></span></div>
				<div class="fls-preloader__counter">0%</div>
			</div>
		`;
            document.body.appendChild(preloaderEl);

            const body = preloaderEl.querySelector('.fls-preloader__body');
            const counterEl = preloaderEl.querySelector('.fls-preloader__counter');
            const lineEl = preloaderEl.querySelector('.fls-preloader__line span');

            requestAnimationFrame(() => {
                preloaderEl.classList.add('visible');
                body.classList.add('visible');
            });

            let counter = 0;
            const interval = setInterval(() => {
                counter++;
                counterEl.textContent = `${counter}%`;
                lineEl.style.width = `${counter}%`;
                if (counter >= 100) {
                    clearInterval(interval);
                    finishPreloader();
                }
            }, 10);

            function finishPreloader() {
                html.classList.add('preloader-done');

                // Запоминаем успешный показ
                localStorage.setItem('fls-preloader-viewed', 'true');

                setTimeout(() => {
                    html.classList.remove('preloader-active');
                    preloaderEl?.remove();
                }, 500);
            }
        }

        preloader();
    </script>
</div>
