function dataTable(table) {
    $(document).ready(function() {
        $(table).DataTable({
            "language": {
                "lengthMenu": "แสดง _MENU_ แถวต่อหน้า",
                "zeroRecords": "Nothing found - sorry",
                "info": "Showing page _PAGE_ of _PAGES_",
                "infoEmpty": "No records available",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": "ค้นหา:",
                "paginate": {
                    "first": "หน้าแรก",
                    "last": "หน้าสุดท้าย",
                    "next": "ต่อไป",
                    "previous": "ก่อนหน้า"
                },
                "info": "แสดงแถว _START_ ถึง _END_ จากทั้งหมด _TOTAL_ แถว",
            }
        });
    });
}