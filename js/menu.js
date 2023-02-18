export function menu() {
    const menu = document.getElementById("menu");

    const hideMenu = "document.getElementById(`menu`).style.animation = `hide-menu 0.5s ease-out 1 forwards`;"

    const btnUsuarios = menu.classList.contains('menu-adm') ? '<a href="/sistema-avaliacaodisciplinas/paginas/Usuarios"><span class="material-icons menu-button">person</span> Usuários</a>' : '';

    menu.innerHTML = 
        '<div class="menu-hide-container"><span id="menu-hide" class="material-icons" onclick="' + hideMenu + '">menu</span></div>'
     +  btnUsuarios
     +  '<a href="/sistema-avaliacaodisciplinas/paginas/Cursos"><span class="material-icons menu-button">school</span> Cursos</a>'
     +  '<a href="/sistema-avaliacaodisciplinas/paginas/Disciplinas"><span class="material-icons menu-button">menu_book</span> Disciplinas</a>'
     +  '<a href="/sistema-avaliacaodisciplinas/paginas/Criticas"><span class="material-icons menu-button">star</span> Críticas</a>'
}