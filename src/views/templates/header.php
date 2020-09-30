<header class="header bg-primary">
    <div class="logo">
        <i class="fas fa-clock"></i>
        Clock-in!
    </div>
    <div class="menu-toggle mx-3">
        <i class="fas fa-bars"></i>
    </div>
    
    <div class="spacer"></div>
    <div class="dropdown">
        <div class="dropdown-button">
            <img 
                class="avatar"
                src="http://gravatar.com/avatar.php?gravatar_id=>
                <?= md5(strtolower(trim($user->email))) ?>" 
                alt=""
            >
            <span class="ml-2"><?= $user->name ?></span>
            <i class="fas fa-chevron-down mx-2"></i>
        </div>
        <div class="dropdown-content">
            <ul class="nav-list">
                <li class="nav-item">
                    <a href="logout"><i class="fas fa-sign-out-alt mr-2"></i>Sair</a>
                </li>
            </ul>
        </div>
    </div>
</header>