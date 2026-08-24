
document.addEventListener('DOMContentLoaded', function (event) {
    var scrollbar = document.body.clientWidth - window.innerWidth + 'px';
    const newsPopular = document.querySelector('div#work-area > div.news-popular');
    if (newsPopular !== null) {
        changeBlockSize(newsPopular);
        addNewBlock(newsPopular);
        addModalBlock();
        addModalCloseEventListener();
    } else if (window.innerWidth < 980 && document.querySelector("div.links-block .news-list .news-item")) {
        const newsBlock = document.querySelector('div.container div#content-wrapper')
        addNewLinkBlock();
        addModalBlock();
        addModalCloseEventListener();
    }

    window.addEventListener('click', function (event) {
        if (event.target.id === "new-modal-open" || event.target.className === "new-modal-dialog") {
            if (event.target.className === "new-modal-dialog") {
                event.target.parentNode.style.display = 'none';
                document.body.style.overflow = 'visible'; 
                return;
            }
            event.target.style.display = 'none';
            document.body.style.overflow = 'visible';            
        }        
    });
});

function addModalCloseEventListener() {    
    const closeButton = document.querySelector('div.new-modal-content a.close');
    const modal = document.querySelector('div.new-modal');
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
    event.preventDefault();   
    const modal = document.querySelector('div.new-modal');    
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
    if (window.innerWidth < 980 && document.querySelector("div.links-block .news-list .news-item")) {
        modal.querySelector('.new-row').style.padding = "0";
    } 
}

function addNewLinkBlock() {
    const parent = document.querySelector('#header .links-block .news-list');

    const newBlock = document.createElement('div');
    newBlock.classList.add('news-item');
    newBlock.classList.add('col-lg-3');
    newBlock.classList.add('news-popular');
    const newLink = document.createElement('a');
    newLink.innerText = "Информационная образовательная платформа";
    newLink.style.fontSize = "small !important";
    newLink.href = '#';
    newBlock.appendChild(newLink);
    parent.appendChild(newBlock);
    newBlock.addEventListener('click', function(event) {
        modalShow(event);
    });
    return;
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
                    <a target='_blank' href='https://do.ucp.by/course/index.php?categoryid=233'>
                        <div class="new-col-6 test-btn new-btn">
                            <p class='button-text'>Высшее образование.
                            <br>Научно-ориентированное образование</p>
                            <div class='button-navy'>do.ucp.by</div>
                        </div>
                    </a>
                    <a target='_blank' href='https://do.ucp.by/course/index.php?categoryid=234'>
                        <div class="new-col-6 online-btn new-btn">
                            <p class='button-text'>Переподготовка на уровне высшего образования, повышение квалификации</p>
                            <div class='button-navy'>do.ucp.by</div>                        
                        </div>
                    </a>
                    <a target='_blank' href='https://online.ucp.by/course/view.php?id=24'>
                        <div class="new-col-6 online-btn new-btn">
                            <p class='button-text'>Обучение лиц, включенных в резерв руководящих кадров ОПЧС</p>
                            <div class='button-navy'>online.ucp.by</div>                        
                        </div>
                    </a>
                    <a target='_blank' href='https://online.ucp.by/course/index.php?categoryid=9'>
                        <div class="new-col-6 online-btn new-btn">
                            <p class='button-text'>Проверка знаний работников ОПЧС</p>
                            <div class='button-navy'>online.ucp.by</div>                        
                        </div>
                    </a>
                    <a target='_blank' href='https://test.ucp.by'>
                        <div class="new-col-6 test-btn new-btn">
                            <p class='button-text'>
                                Подготовка к проверке знаний по пожарной и промышленной безопасности
                                <br>
                                <span style="font-size: x-small;font-style: italic;">(соискатели лицензий и разрешений)</span>
                            </p>
                            <div class='button-navy'>test.ucp.by</div>
                        </div>
                    </a>
                    <a target='_blank' href='https://do.ucp.by/course/view.php?id=1275'>
                        <div class="new-col-6 online-btn new-btn">
                            <p class='button-text'>ГЕНОЦИД БЕЛОРУССКОГО НАРОДА В ГОДЫ ВЕЛИКОЙ ОТЕЧЕСТВЕННОЙ ВОЙНЫ</p>
                            <div class='button-navy'>do.ucp.by</div>                        
                        </div>
                    </a>
                </div>
            </div>
        </div>
        </div>
    </div>
    `;    
}