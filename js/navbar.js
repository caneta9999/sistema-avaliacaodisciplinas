export function navbar() {
    const navbar = document.getElementById("navbar");

    const showMenu = "document.getElementById(`menu`).style.animation = `show-menu 0.5s ease-out 1 forwards`"

    navbar.innerHTML = "<header>" 
        + "<span class='material-icons' id='menu-show' onclick='" + showMenu + "'>menu</span>"
        + "<a href='/sistema-avaliacaodisciplinas/paginas/index.php'><img class='logo' src='/sistema-avaliacaodisciplinas/imgs/logo-sistema.png' alt=''></a>"
		+ "<div id='divProfileLogout'>"
		+ "<form id='formMeuPerfil' method='POST' action='/sistema-avaliacaodisciplinas/paginas/Usuarios/Alterar/php1.php'>"
		+ "<button type='submit' name='submit' class='button-go-my-profile' value='Enviar'><span class='material-icons button-go-my-profile'>account_circle</span>Meu Perfil</button>"
        + "</form>"        
		+ "<form id='formLogout' method='POST' action='/sistema-avaliacaodisciplinaspaginas/Login/logout.php'>"
        + "<button class='button-go-logout' id='inputSubmit' name='sairSubmit' type='submit'><span class='material-icons button-go-logout'>logout</span>Sair</button>"
        + "</form>"
		+ "</div>"
        + "</header>"
    return navbar;
}

