

    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Cisangkan &copy; Absence Digital <?= date("Y") ?></div>
            </div>
        </div>
    </footer>
</div>

<script src="{{ asset('') }}assets/plugins/bootstrap/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('') }}js/scripts.js"></script>
<script src="/main.js"></script>
<script src="{{ asset('') }}assets/jquery/datatables.min.js"></script>
<script type="text/javascript" src="{{asset('')}}assets/jquerysignature/jquery.signature.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{asset('')}}assets/jquerysignature/signature_pad.js"></script>
<script src="{{asset('')}}assets/jqueryexportexcel/jquery.table2excel.js"></script>
<script src="{{asset('')}}assets/jqueryexportexcel/tableHTMLExport.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.5/jspdf.plugin.autotable.min.js"></script>
<script type="text/javascript" src="{{asset('')}}assets/webcam/webcam.min.js"></script>

@yield('pagespecificscripts')
<script>
    window.onload = () => {
        'use strict';
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker
                    .register('./sw.js');
        }
    }
</script>
</body>
</html>
