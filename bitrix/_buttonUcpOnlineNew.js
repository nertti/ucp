
document.addEventListener('DOMContentLoaded', function (event) {
    var scrollbar = document.body.clientWidth - window.innerWidth + 'px';
    const newsPopular = document.querySelector('div#work-area > div.news-popular');
    if (newsPopular !== null) {
        changeBlockSize(newsPopular);
        addNewBlock(newsPopular);
        addModalBlock();
        addModalCloseEventListener();
    }

    window.addEventListener('click', function (event) {
        if (event.target.id === "new-modal-open") {
            event.target.style.display = 'none';
            document.body.style.overflow = 'visible';            
        }
    });
});

function addModalCloseEventListener() {    
    const closeButton = document.querySelector('div.new-modal-content a.close');
    const modal = document.querySelector('div.new-modal');
    console.log(closeButton, modal)
    if (closeButton !== null && modal !== null) {
        closeButton.addEventListener('click', function () {
            modal.style.display = 'none';
            document.body.style.overflow = 'visible';            
        });
    }    
}

function changeBlockSize(newsPopular) {
    newsPopular.style.transition = "height 300ms ease-in";
    newsPopular.style.height = `508px`;
}

function modalShow(event) {    
    const modal = document.querySelector('div.new-modal');    
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

function addNewBlock(newsPopular) {
    const newBlock = document.createElement('div');

    newBlock.classList.add('news-popular');
    newBlock.style.height = "82px";
    newBlock.style.cursor = "pointer";
    newBlock.style.transition = "height 300ms ease-in";
    newBlock.style.background = "center / contain no-repeat url('/images/reserve/reserve_banner_site4.jpg')";
    
    newBlock.addEventListener('click', function(event) {
        modalShow(event);
    });

    newsPopular.parentNode.insertBefore(newBlock, newsPopular);
}

function addModalBlock() {
    const modalWindow = document.createElement('div');
    document.querySelector('body').appendChild(modalWindow);
    modalWindow.outerHTML = `
    <div id="new-modal-open" class="new-modal">
        <div class="new-modal-dialog">
        <div class="new-modal-content">
            <div class="new-modal-header">
                <h3 class="new-modal-title">Информационная образовательная платформа</h3>
                <a href="#close" title="Закрыть окно" class="close">×</a>
            </div>
            <div class="new-modal-body">
                <div class='new-row online-test-buttons'>
                    <a href='https://test.ucp.by'>
                        <div class="new-col-6 test-btn new-btn">
                            <p class='button-text'>Подготовка к проверке знаний по пожарной и промышленной безопасности</p>
                            <div class='button-navy'>test.ucp.by</div>
                        </div>
                    </a>
                    <a href='https://online.ucp.by'>
                        <div class="new-col-6 online-btn new-btn">
                            <p class='button-text'>Обучение лиц, включенных в резерв руководящих кадров</p>
                            <div class='button-navy'>online.ucp.by</div>                        
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
    `;    
}