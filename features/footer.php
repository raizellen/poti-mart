<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/poti assignment 1/assets/styles/footer.css">
    <script src="/poti assignment 1/assets/js/cart.js" defer></script>
</head>

<footer id="site-footer">
    <p>POTI Mart | UTS Programming on the Internet (31748): Assignment 1 | Created by Raizelle Nana (24825960)</p>
</footer>
<script>
    function toggleFooter() {
        const footer = document.getElementById('site-footer');
        const atBottom = window.innerHeight + window.scrollY >= document.body.offsetHeight;

        if (atBottom || document.body.scrollHeight <= window.innerHeight) {
            footer.classList.add('show');
        } else {
            footer.classList.remove('show');
        }
    }

    window.addEventListener('scroll', toggleFooter);
    window.addEventListener('load', toggleFooter);
    window.addEventListener('resize', toggleFooter);
</script>

</html>