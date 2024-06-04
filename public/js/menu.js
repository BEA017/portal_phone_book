document.addEventListener('DOMContentLoaded', function() {
    const menuLinks = document.querySelectorAll('.menu-link');

    menuLinks.forEach(function(menuLink) {
        menuLink.addEventListener('click', function() {
            // Удаляем класс 'active' у всех пунктов меню
            menuLinks.forEach(function(link) {
                link.classList.remove('active');
            });

            // Добавляем класс 'active' только к текущему пункту меню
            menuLink.classList.add('active');
        });
    });
});

document.addEventListener('DOMContentLoaded', function () {
     var input = document.getElementsByClassName("content");
     console.log("input:"+input.length);
  // alert( input[0].id)
  /*  switch (a) {
        case 3:
          alert( 'Маловато' );
          break;
        case 4:
          alert( 'В точку!' );
          break;
        case 5:
          alert( 'Перебор' );
          break;
        default:
          alert( "Нет таких значений" );
        */
   })
