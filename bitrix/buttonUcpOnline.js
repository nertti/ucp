
document.addEventListener('DOMContentLoaded', function (event) {
    console.log('buttonUcpOnline.js')
    const newsPopular = document.querySelector('div#work-area > div.news-popular');
    if (newsPopular !== null) {
        changeBlockSize(newsPopular);
        addNewBlock(newsPopular);
    }
});

function changeBlockSize(newsPopular) {
    newsPopular.style.height = `508px`;
}

function modalShow(event) {
    window.location.href = "https://online.ucp.by";
    console.log(event.target)
}

function addNewBlock(newsPopular) {
    const newBlock = document.createElement('div');
    /* newBlock.innerHTML = `
    `; */
    newBlock.classList.add('news-popular');
    newBlock.style.height = "82px";
    newBlock.style.cursor = "pointer";
    newBlock.style.background = "center / contain no-repeat url('/images/reserve/reserve_banner_site4.jpg')";
    
    newBlock.addEventListener('click', function(event) {
        modalShow(event);
    });

    newsPopular.parentNode.insertBefore(newBlock, newsPopular);
}