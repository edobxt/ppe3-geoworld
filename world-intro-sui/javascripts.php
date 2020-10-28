
    <script src="assets/library/jquery.min.js"></script>
    <script src="semantic/semantic.js"></script>
    <script>
        $(document)
            .ready(function() {
                console.log("execution de codes JS après chargement de la page");

                $('.ui.menu a.item')
                    .on('click', function() {
                        $(this)
                            .addClass('active')
                            .siblings().removeClass('active')
                        ;
                    })

                ;
            })
        ;
    </script>
