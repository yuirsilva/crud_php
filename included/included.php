<header>
    <div class="upper-header">
        <a href="#" class="logo">ETEC</a>
        <div class="nav">
            <div class="menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
        <div class="nav close">
            <img src="/fand/style/imgs/menuClose.svg" alt="Close menu cross">
        </div>
    </div>
    <div class="menu-m">
        <?php require_once('config.php'); ?>
        <div class="link-wrapper">
            <div>
                <a href="<?= $path ?>fand/index.php#faq" class="link">
                    <h6>01.</h6>
                    <h1 class="h1-link">FAQ</h1>
                    <h1 class="link-serif">faq</h1>
                </a>
            </div>
            <div class="menu-additional-info">
                <p>Para empresas e alunos que tenham um objetivo no mercado de trabalho.</p>
                <div class="add-info">
                    <p>671%</p>
                    <div class="box">
                        <p>"Procura por profissionais de tecnologia cresce 671% durante a pandemia"</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="link-wrapper">
            <div>
                <a href="<?= $path ?>fand/login/login.php" class="link" rel="noopener noreferrer">
                    <h6>02.</h6>
                    <h1 class="h1-link">Entrar</h1>
                    <h1 class="link-serif">entrar</h1>
                </a>
            </div>
            <div class="menu-additional-info">
                <div class="add-info">
                    <p>408.000</p>
                    <div class="box">
                        <p>"Pesquisa prevê carência de 408 mil profissionais de TI até 2022"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    const lerp = (start, end, vl) =>
    {
        return (1.-vl)*start+vl*end
    }
</script>