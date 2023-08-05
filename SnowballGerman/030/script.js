
$(document).ready(function(){
    $('.menu-toggle').click(function(){
      $('.menu-toggle').toggleClass('active')
      $('nav').toggleClass('active')
    })
  });


function color ()
{
  var element = document.querySelector('html');
  element.classList.toggle('dark');
}