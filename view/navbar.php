<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #D97A33;">
    <!-- Container wrapper -->
    <div class="container">

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse" id="navbarButtonsExample">
        <!-- Left links -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!-- <li class="nav-item">
                <a class="nav-link" href="/">Dashboard</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-text text-white" href="/finances">HOME</a>
            </li>
        </ul>
        <!-- Left links -->

        <div class="d-flex align-items-center">
            <?php if($_SESSION['user']['email'] ?? false): ?>
                <span class="navbar-text text-white me-2">
                    <?= $_SESSION['user']['email'] ?>
                </span>
                <span class="navbar-text me-2">
                    <button class="btn btn-primary btn-sm">
                        <a href="/logout" class="btn btn-primary btn-sm">Logout</a>
                    </button>
                </span>
                <?php else: ?>
                <span class="navbar-text me-2">
                    <a href="/login" class="btn btn-primary">Login</a>
                </span>
                <span class="navbar-text me-2">
                |
                </span>
                <span class="navbar-text me-2">
                    <a href="/register" class="btn btn-primary btn-sm text-white">Register</a>
                </span>
            <?php endif; ?>
        </div>
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->