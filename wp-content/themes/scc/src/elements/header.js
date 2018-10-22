document.addEventListener('DOMContentLoaded', function() {
  const menuOpenBtn = document.getElementById('scc-menu-icon-open')
  const menuCloseBtn = document.getElementById('scc-menu-icon-close')

  if (!menuOpenBtn || !menuCloseBtn) {
    return
  }

  menuOpenBtn.addEventListener('click', () => document.body.classList.add('menu-opened'))
  menuCloseBtn.addEventListener('click', () => document.body.classList.remove('menu-opened'))

  const menuDimEl = document.getElementById('scc-menu-dim')

  menuDimEl && menuDimEl.addEventListener('click', () => document.body.classList.remove('menu-opened'))
})
