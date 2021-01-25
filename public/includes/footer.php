</main>

<footer class="mt-auto text-white-50">
    <p>Andras Margittai 2021 <br>Allrights reserved.</p>
</footer>
</div>
</body>
<script>
    //collect navmenu Elements
    const navMenuArr = Array.from(document.querySelectorAll(".nav-link"))
    navMenuArr.map(navElement => {
        //remove active class from all menu
        //the activePage is fix on each side for the moment
        navElement.classList.remove("active");
        if (navElement.innerHTML == activePage) {
            navElement.classList.add("active");
        }
    })
</script>

</html>