$(document).ready(function() {
    $('.navbar-toggler').click(function() {
        $('.page__navbar').slideToggle(300);  // 300 é a duração da animação em milissegundos
        $('.page__navbar').toggleClass('full-width'); // Adiciona/remova a classe 'full-width'
    });
    $('.close-button').click(function() {
        $('.page__navbar').slideToggle(100);  // 300 é a duração da animação em milissegundos
        $('.page__navbar').toggleClass('full-width'); // Adiciona/remova a classe 'full-width'
    });
});

document.addEventListener("DOMContentLoaded", function(){
    document.querySelectorAll('.sidebar .nav-link').forEach(function(element){
        element.addEventListener('click', function (e) {
            let nextEl = element.nextElementSibling;
            let parentEl  = element.parentElement;

            if(nextEl) {
                e.preventDefault();
                let mycollapse = new bootstrap.Collapse(nextEl);
                let icon = element.querySelector('.nav-link-menu-icon');

                if(nextEl.classList.contains('show')){
                    mycollapse.hide();
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    mycollapse.show();
                    if(icon.classList.contains('fa-chevron-up')) {
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }else{
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    }

                    // find other submenus with class=show
                    var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                    // if it exists, then close all of them
                    if(opened_submenu){
                        new bootstrap.Collapse(opened_submenu);
                    }
                }
            }
        }); // addEventListener
    }) // forEach
});

