function filterMenuSidebar(value='') {
  $('.c-sidebar-nav li.c-sidebar-nav-item').filter(function (){
      if ($(this).hasClass('c-sidebar-nav-dropdown')) {
          if (!$(this).hasClass('c-show')) {
              $(this).addClass('c-show');
          }
      }
      let item = to_slug($(this).text());
      localStorage.setItem('filterMenuValue', value);
      $(this).toggle(item.indexOf(to_slug(value)) > -1);
  });
}
