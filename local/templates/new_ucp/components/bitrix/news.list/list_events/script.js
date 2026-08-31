document.addEventListener('DOMContentLoaded', function () {

    const id = new URLSearchParams(window.location.search).get('id');

    if (id) {
        const element = document.querySelector(`[data-event-id="${id}"]`);
console.log(element)
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
});
