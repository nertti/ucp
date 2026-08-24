<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Партнеры");

// Получаем элементы инфоблока
if(CModule::IncludeModule("iblock")) {
	$arSelect = Array("ID", "NAME", "PREVIEW_TEXT", "PREVIEW_PICTURE", "PROPERTY_LINK", "PROPERTY_TYPE", "PROPERTY_UP");
	$arFilter = Array("IBLOCK_ID"=>1, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, $arSelect);
	while($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();
		$arFields["PROPERTIES"] = $ob->GetProperties();
		$arResult["ITEMS"][] = $arFields;
	}
}
?>
<style>
	.partners-slider-wrap {
		position: relative;
		margin: 30px 0;
		padding: 0 50px;
	}
	
	.partners-slider-wrap .slider-track {
		overflow: hidden;
		position: relative;
	}
	
	.partners-slider-wrap .slider-list {
		display: flex;
		transition: transform 0.5s ease;
		list-style: none;
		padding: 0;
		margin: 0;
		gap: 15px;
		will-change: transform;
	}
	
	.partners-slider-wrap .slider-list li {
		flex: 0 0 calc(20% - 15px);
		min-width: calc(20% - 15px);
		background: transparent;
		border-radius: 8px;
		padding: 10px;
		text-align: center;
		transition: transform 0.3s;
		height: 180px;
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		box-sizing: border-box;
	}
	
	.partners-slider-wrap .slider-list li:hover {
		transform: translateY(-5px);
	}
	
	.partners-slider-wrap .slider-list li a {
		text-decoration: none;
		color: #333;
		display: flex;
		flex-direction: column;
		align-items: center;
		width: 100%;
		height: 100%;
		justify-content: center;
	}
	
	.partners-slider-wrap .slider-list li i {
		display: block;
		margin-bottom: 10px;
		width: 100%;
		height: 100px;
	}
	
	.partners-slider-wrap .slider-list li i img {
		width: 100%;
		height: 100%;
		object-fit: contain;
	}
	
	.partners-slider-wrap .slider-list li span {
		font-size: 13px;
		color: #666;
		display: block;
	}
	
	/* Стрелки навигации */
	.partners-slider-wrap .slider-btn {
		position: absolute;
		top: 50%;
		transform: translateY(-50%);
		cursor: pointer;
		font-size: 40px;
		color: #ccc;
		transition: all 0.3s;
		z-index: 10;
		display: flex;
		align-items: center;
		justify-content: center;
		width: 40px;
		height: 40px;
		user-select: none;
	}
	
	.partners-slider-wrap .slider-btn:hover {
		color: #333;
	}
	
	.partners-slider-wrap .slider-btn.prev {
		left: 0;
	}
	
	.partners-slider-wrap .slider-btn.next {
		right: 0;
	}
	
	.partners-slider-wrap .slider-btn em {
		font-style: normal;
		font-size: 40px;
		line-height: 1;
		display: block;
	}
	
	/* Индикаторы (точки) */
	.partners-slider-wrap .slider-dots {
		display: flex;
		justify-content: center;
		gap: 8px;
		margin-top: 15px;
	}
	
	.partners-slider-wrap .slider-dots button {
		width: 10px;
		height: 10px;
		border-radius: 50%;
		border: none;
		background: #ddd;
		cursor: pointer;
		transition: all 0.3s;
		padding: 0;
	}
	
	.partners-slider-wrap .slider-dots button.active {
		background: #999;
	}
	
	.partners-slider-wrap .slider-dots button:hover {
		background: #999;
		transform: scale(1.2);
	}
	
	.empty-message {
		text-align: center;
		padding: 40px;
		color: #999;
		font-size: 16px;
	}
	
	@media (max-width: 1200px) {
		.partners-slider-wrap .slider-list li {
			flex: 0 0 calc(25% - 15px);
			min-width: calc(25% - 15px);
			height: 160px;
		}
		.partners-slider-wrap .slider-btn {
			font-size: 34px;
			width: 34px;
			height: 34px;
		}
		.partners-slider-wrap .slider-btn em {
			font-size: 34px;
		}
	}
	
	@media (max-width: 992px) {
		.partners-slider-wrap .slider-list li {
			flex: 0 0 calc(33.333% - 15px);
			min-width: calc(33.333% - 15px);
			height: 160px;
		}
	}
	
	@media (max-width: 768px) {
		.partners-slider-wrap {
			padding: 0 40px;
		}
		.partners-slider-wrap .slider-list li {
			flex: 0 0 calc(50% - 15px);
			min-width: calc(50% - 15px);
			height: 150px;
		}
		.partners-slider-wrap .slider-list li i {
			height: 80px;
		}
		.partners-slider-wrap .slider-btn {
			font-size: 30px;
			width: 30px;
			height: 30px;
		}
		.partners-slider-wrap .slider-btn em {
			font-size: 30px;
		}
	}
	
	@media (max-width: 480px) {
		.partners-slider-wrap {
			padding: 0 30px;
		}
		.partners-slider-wrap .slider-list li {
			flex: 0 0 calc(100% - 15px);
			min-width: calc(100% - 15px);
			height: 140px;
		}
		.partners-slider-wrap .slider-list li i {
			height: 70px;
		}
		.partners-slider-wrap .slider-btn {
			font-size: 26px;
			width: 26px;
			height: 26px;
		}
		.partners-slider-wrap .slider-btn em {
			font-size: 26px;
		}
	}
</style>

<?
$hasItems = false;
$filteredItems = array();

foreach($arResult["ITEMS"] as $arItem) {
	if($arItem["PROPERTIES"]["UP"]["VALUE"]) {
		$hasItems = true;
		$filteredItems[] = $arItem;
	}
}

if($hasItems) {
	?>
	<div class="partners-slider-wrap" id="partners-slider-1">
		<div class="slider-track">
			<ul class="slider-list" id="slider-list-1">
				<?foreach($filteredItems as $arItem):?>
					<li>
						<a href="<?=$arItem["PROPERTIES"]["LINK"]["VALUE"]?>" target="_blank">
							<i><img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?echo $arItem["NAME"]?>"></i>
							<?=$arItem["PROPERTIES"]["TYPE"]["VALUE"]?>
						</a>
					</li>
				<?endforeach;?>
			</ul>
		</div>
		
		<div class="slider-btn prev" id="prev-1">
			<em>&#8249;</em>
		</div>
		<div class="slider-btn next" id="next-1">
			<em>&#8250;</em>
		</div>
		
		
	</div>
	<?
} else {
	?>
	<div class="empty-message">
		<p>Нет активных партнеров для отображения</p>
	</div>
	<?
}
?>

<script>
(function() {
	'use strict';
	
	function initSlider(sliderId) {
		const container = document.getElementById(sliderId);
		if (!container) return;
		
		const list = container.querySelector('.slider-list');
		const prevBtn = container.querySelector('.prev');
		const nextBtn = container.querySelector('.next');
		const dotsContainer = container.querySelector('.slider-dots');
		
		if (!list) return;
		
		let items = list.querySelectorAll('li');
		const totalItems = items.length;
		let currentIndex = 0;
		let autoPlayTimer = null;
		let isTransitioning = false;
		
		if (totalItems <= 1) {
			if (prevBtn) prevBtn.style.display = 'none';
			if (nextBtn) nextBtn.style.display = 'none';
			if (dotsContainer) dotsContainer.style.display = 'none';
			return;
		}
		
		// Клонируем элементы для бесконечной прокрутки
		const itemsPerSlide = getItemsPerSlide();
		const cloneCount = itemsPerSlide * 2; // Клонируем для плавности
		
		// Клонируем первые элементы в конец
		for (let i = 0; i < cloneCount && i < totalItems; i++) {
			const clone = items[i].cloneNode(true);
			list.appendChild(clone);
		}
		
		// Клонируем последние элементы в начало
		for (let i = totalItems - 1; i >= totalItems - cloneCount && i >= 0; i--) {
			const clone = items[i].cloneNode(true);
			list.insertBefore(clone, list.firstChild);
		}
		
		// Обновляем список элементов
		items = list.querySelectorAll('li');
		const totalClonedItems = items.length;
		
		// Устанавливаем начальную позицию (после клонов в начале)
		const initialOffset = cloneCount;
		currentIndex = initialOffset;
		
		// Функция для определения количества элементов на странице
		function getItemsPerSlide() {
			const width = window.innerWidth;
			if (width <= 480) return 1;
			if (width <= 768) return 2;
			if (width <= 992) return 3;
			if (width <= 1200) return 4;
			return 5;
		}
		
		// Функция для получения ширины одного элемента с учетом gap
		function getItemWidth() {
			const firstItem = items[0];
			if (!firstItem) return 0;
			
			const style = window.getComputedStyle(firstItem);
			const marginLeft = parseFloat(style.marginLeft) || 0;
			const marginRight = parseFloat(style.marginRight) || 0;
			const totalWidth = firstItem.offsetWidth + marginLeft + marginRight;
			
			const listStyle = window.getComputedStyle(list);
			const gap = parseFloat(listStyle.gap) || 15;
			
			return totalWidth + gap;
		}
		
		function updateSlider(animate = true) {
			const itemWidth = getItemWidth();
			const offset = -currentIndex * itemWidth;
			
			if (!animate) {
				list.style.transition = 'none';
			} else {
				list.style.transition = 'transform 0.5s ease';
			}
			
			list.style.transform = `translateX(${offset}px)`;
			
			if (!animate) {
				void list.offsetHeight;
				list.style.transition = 'transform 0.5s ease';
			}
			
			updateDots();
		}
		
		function updateDots() {
			if (!dotsContainer) return;
			
			const itemsPerSlide = getItemsPerSlide();
			const totalSlides = Math.ceil(totalItems / itemsPerSlide);
			
			dotsContainer.innerHTML = '';
			for (let i = 0; i < totalSlides; i++) {
				const dot = document.createElement('button');
				const currentSlide = Math.floor((currentIndex - cloneCount) / itemsPerSlide);
				let slideIndex = currentSlide;
				
				// Нормализуем индекс для бесконечной прокрутки
				if (slideIndex < 0) slideIndex = totalSlides - 1;
				if (slideIndex >= totalSlides) slideIndex = 0;
				
				dot.className = i === slideIndex ? 'active' : '';
				dot.dataset.index = i;
				dot.addEventListener('click', function() {
					const slideIndex = parseInt(this.dataset.index);
					const itemsPerSlide = getItemsPerSlide();
					const newIndex = cloneCount + slideIndex * itemsPerSlide;
					goToSlide(newIndex);
				});
				dotsContainer.appendChild(dot);
			}
		}
		
		function goToSlide(index, animate = true) {
			if (isTransitioning && animate) return;
			
			const itemsPerSlide = getItemsPerSlide();
			const maxIndex = totalClonedItems - itemsPerSlide;
			
			if (index < 0) index = 0;
			if (index > maxIndex) index = maxIndex;
			
			isTransitioning = true;
			currentIndex = index;
			updateSlider(animate);
			
			// Проверяем, нужно ли переключиться на клоны
			setTimeout(() => {
				if (currentIndex >= totalClonedItems - itemsPerSlide) {
					// Дошли до конца - переключаемся на начало
					const newIndex = cloneCount + (currentIndex - (totalClonedItems - itemsPerSlide));
					currentIndex = newIndex;
					updateSlider(false);
				} else if (currentIndex < cloneCount) {
					// Дошли до начала - переключаемся на конец
					const newIndex = totalClonedItems - cloneCount - (cloneCount - currentIndex);
					if (newIndex < totalClonedItems - itemsPerSlide) {
						currentIndex = newIndex;
						updateSlider(false);
					}
				}
				isTransitioning = false;
			}, animate ? 500 : 0);
		}
		
		function nextSlide() {
			const itemsPerSlide = getItemsPerSlide();
			const nextIndex = currentIndex + 1;
			goToSlide(nextIndex);
		}
		
		function prevSlide() {
			const prevIndex = currentIndex - 1;
			goToSlide(prevIndex);
		}
		
		function startAutoPlay() {
			stopAutoPlay();
			autoPlayTimer = setInterval(() => {
				nextSlide();
			}, 5000);
		}
		
		function stopAutoPlay() {
			if (autoPlayTimer) {
				clearInterval(autoPlayTimer);
				autoPlayTimer = null;
			}
		}
		
		if (prevBtn) {
			prevBtn.addEventListener('click', function(e) {
				e.preventDefault();
				prevSlide();
				stopAutoPlay();
				startAutoPlay();
			});
		}
		
		if (nextBtn) {
			nextBtn.addEventListener('click', function(e) {
				e.preventDefault();
				nextSlide();
				stopAutoPlay();
				startAutoPlay();
			});
		}
		
		let resizeTimer;
		window.addEventListener('resize', function() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function() {
				updateDots();
			}, 250);
		});
		
		// Инициализация
		setTimeout(() => {
			currentIndex = cloneCount;
			updateSlider(false);
		}, 100);
		
		startAutoPlay();
		
		container.addEventListener('mouseenter', stopAutoPlay);
		container.addEventListener('mouseleave', startAutoPlay);
		
		return {
			next: nextSlide,
			prev: prevSlide,
			goTo: goToSlide,
			destroy: function() {
				stopAutoPlay();
				container.removeEventListener('mouseenter', stopAutoPlay);
				container.removeEventListener('mouseleave', startAutoPlay);
			}
		};
	}
	
	document.addEventListener('DOMContentLoaded', function() {
		const sliders = document.querySelectorAll('.partners-slider-wrap');
		sliders.forEach(function(slider) {
			if (slider.id) {
				initSlider(slider.id);
			}
		});
	});
})();
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>