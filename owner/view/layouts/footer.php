  <!-- <footer class="footer">&copy; etari creatives</footer> -->
    <!-- STYLE SWITCHER -->
    <div class="del-style-switcher">
        <div class="del-switcher-toggle toggle-hide"></div>
        <form>
            <section class="del-section del-section-skin">
                <h5 class="del-switcher-header">Choose Skins:</h5>
                <ul>
                    <li><a href="#" title="Slate Gray" class="switch-skin slategray" data-skin="includes/assets/css/skins/slategray.css">Slate Gray</a></li>
                    <li><a href="#" title="Dark Blue" class="switch-skin darkblue" data-skin="includes/assets/css/skins/darkblue.css">Dark Blue</a></li>
                    <li><a href="#" title="Dark Brown" class="switch-skin darkbrown" data-skin="includes/assets/css/skins/darkbrown.css">Dark Brown</a></li>
                    <li><a href="#" title="Light Green" class="switch-skin lightgreen" data-skin="includes/assets/css/skins/lightgreen.css">Light Green</a></li>
                    <li><a href="#" title="Orange" class="switch-skin orange" data-skin="includes/assets/css/skins/orange.css">Orange</a></li>
                    <li><a href="#" title="Red" class="switch-skin red" data-skin="includes/assets/css/skins/red.css">Red</a></li>
                    <li><a href="#" title="Teal" class="switch-skin teal" data-skin="includes/assets/css/skins/teal.css">Teal</a></li>
                    <li><a href="#" title="Yellow" class="switch-skin yellow" data-skin="includes/assets/css/skins/yellow.css">Yellow</a></li>
                </ul>
                <div id="transparent-control"></div>
                <button type="button" class="switch-skin-full fulldark" data-skin="includes/assets/css/skins/fulldark.css">Full Dark</button>
                <button type="button" class="switch-skin-full fullbright" data-skin="includes/assets/css/skins/fullbright.css">Full Bright</button>
            </section>
            <p><a href="#" title="Reset Style" class="del-reset-style">Reset Style</a></p>
        </form>
        <script type="text/javascript">
        var currentFilename = window.location.pathname.split('http://demo.thedevelovers.com/').pop();
        if (currentFilename == '') currentFilename = 'index.php';

        var arrHasTransparent = ['index.html', 'index-dashboard-v2.html', 'charts-statistics-interactive.html', 'charts-statistics-real-time.html',
            'charts-statistics.html', 'components-maps.html', 'components-tree-view.html', 'page-file-manager.html'
        ];

        var hasTransparent = false;

        arrHasTransparent.forEach(function(filename) {
            if (filename == currentFilename) {
                hasTransparent = true;
                return;
            }
        });

        if (hasTransparent) {
            document.getElementById("transparent-control").innerHTML = '<p><em>There is specific transparent version for this page, check <span class="important">&larr; left</span> navigation menu</em></p><br>';
        } else {
            document.getElementById("transparent-control").innerHTML = '<button type="button" class="switch-skin-full transparent" data-skin="assets/css/skins/transparent.css">Transparent</button>';
        }
        </script>
    </div>
    <!-- END STYLE SWITCHER -->
    <!-- Javascript -->
    <script type="text/javascript" src="../includes/assets/js/jquery-3.3.1.min.js"></script>
    <!-- <script type="text/javascript" src="../includes/assets/js/jquery/jquery-3.3.1.min.js"></script> -->
    <script type="text/javascript" src="includes/assets/js/jquery/jquery-1.11.1.min.js"></script>
    <!-- <script type="text/javascript" src="includes/assets/js/jquery/jquery-2.1.0.min.js"></script> -->
    <script type="text/javascript" src="includes/assets/js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="includes/assets/js/plugins/modernizr/modernizr.js"></script>
    <script type="text/javascript" src="includes/assets/js/plugins/bootstrap-tour/bootstrap-tour.custom.js"></script>
    <script type="text/javascript" src="includes/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="includes/assets/js/king-common.js"></script>
    <script type="text/javascript" src="includes/demo-style-switcher/assets/js/deliswitch.js"></script>
    <script type="text/javascript"src="includes/assets/js/plugins/bootstrap-switch/bootstrap-switch.min.js"></script>

    <script type="text/javascript" src="includes/assets/js/plugins/summernote/summernote.min.js"></script>

    <script type="text/javascript" src="includes/assets/js/plugins/datatable/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/datatable/exts/dataTables.colVis.bootstrap.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/datatable/exts/dataTables.colReorder.min.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/datatable/exts/dataTables.tableTools.min.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/datatable/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/jqgrid/jquery.jqGrid.min.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/jqgrid/i18n/grid.locale-en.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/jqgrid/jquery.jqGrid.fluid.js"></script>

    <script type="text/javascript" src="includes/assets/js/plugins/markdown/markdown.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/markdown/to-markdown.js"></script>
	<script type="text/javascript" src="includes/assets/js/plugins/markdown/bootstrap-markdown.js"></script>
	<script type="text/javascript" src="includes/assets/js/king-elements.js"></script>

    
    <script type="text/javascript" src="includes/assets/js/king-page.js"></script>

    


    <script src="../includes/assets/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../includes/assets/js/additional-methods.min.js" type="text/javascript"></script>

    <script src="../includes/assets/js/showimage.js" type="text/javascript"></script>
    <script src="../includes/assets/js/etari.js" type="text/javascript"></script>
    <script type="text/javascript" src="includes/assets/owner.js"></script>
    <script type="text/javascript" src="includes/assets/res.js"></script>
</body>
</html>