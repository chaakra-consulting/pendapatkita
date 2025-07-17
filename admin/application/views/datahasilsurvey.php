<div class="container">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <!-- <h4 class="content-title mb-0 my-auto">Hasil Survey</h4> -->
        </div>
        <br>
        <br>
        <div class="main-dashboard-header-right">
            <a href="<?= base_url() ?>"><button class="btn btn-large btn-flat btn-danger"><i class="fa fa-arrow-left"></i> Back</button></a> &nbsp;
            <a href="<?= base_url() ?>hasil/<?= $id ?>" target="blank_"><button class="btn btn-large btn-flat btn-success"><i class="fa fa-download"></i> Unduh Hasil </button></a> &nbsp;
        </div>
        <br>
    </div>
    <div class="row row-sm row-deck">
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mg-b-0">Hasil Survey</h4>
                        <button id="delete-selected" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i> Hapus Terpilih
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-x:auto;">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0"><input type="checkbox" name="" id="check-all" value="1"></th>
                                    <th class="border-bottom-0" width="70px">No.</th>
                                    <th class="border-bottom-0">Pewawancara</th>
                                    <th class="border-bottom-0">Pemeriksa</th>
                                    <th class="border-bottom-0">Responden</th>
                                    <th class="border-bottom-0">Waktu</th>
                                    <th class="border-bottom-0">Foto</th>
                                    <th class="border-bottom-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($hasilsurvey as $ju) {
                                ?>
                                    <tr>
                                        <td><input type="checkbox" class="check-item" name="ids[]" value="<?= $ju->js_id; ?>"></td>
                                        <td><?= $no++; ?>.</td>
                                        <td><?= $ju->js_pewawancara; ?></td>
                                        <td><?= $ju->js_pemeriksa; ?></td>
                                        <td><?= $ju->js_kode_responden; ?>-<?= $ju->js_nama_responden; ?></td>
                                        <td><?= TglIndo($ju->js_waktu); ?></td>
                                        <td>
                                            <?php
                                            $array_foto = json_decode($ju->js_foto, TRUE);
                                            if (is_array($array_foto)) {
                                                if (count($array_foto) > 0) {
                                                    for ($i = 0; $i < count($array_foto); $i++) { ?>
                                                        <img data-src="<?= base_url(); ?>./../assets/validasi/<?= $array_foto[$i] ?>" class="lazyload" style="width:100px;">
                                                <?php }
                                                }
                                            } else { ?>
                                                <img data-src="<?= base_url(); ?>./../assets/validasi/<?= $ju->js_foto ?>" style="width:100px;" class="lazyload">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-danger delete"
                                                data-id="<?= $ju->js_id; ?>"
                                                data-toggle="tooltip"
                                                title="Hapus Data">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let csrfName = '<?php echo $this->security->get_csrf_token_name(); ?>';
    let csrfHash = '<?php echo $this->security->get_csrf_hash(); ?>';

    document.addEventListener("DOMContentLoaded", function () {
        const checkAll = document.getElementById('check-all');
        const checkboxes = document.querySelectorAll('.check-item');

        if (checkAll) {
            checkAll.addEventListener('change', function () {
                checkboxes.forEach(cb => {
                    cb.checked = checkAll.checked;
                });
            });
        }
    });

    $(document).ready(function () {
        function updateRowNumbers() {
            $('tbody tr').each(function(index) {
                $(this).find('td:eq(1)').text((index + 1) + '.');
            });
        }

        $('#delete-selected').on('click', function() {
            let selected = [];
            $('.check-item:checked').each(function() {
                selected.push($(this).val());
            });

            if (selected.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak ada data yang dipilih',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Anda akan menghapus ' + selected.length + ' data!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("admin/delete_selected") ?>',
                        type: 'POST',
                        data: {
                            ids: selected,
                            [csrfName]: csrfHash 
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil dihapus.',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    $('.check-item:checked').each(function() {
                                        $(this).closest('tr').remove();
                                    });
                                    updateRowNumbers();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus data.'
                                });
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan saat menghapus data. Status: ' + xhr.status
                            });
                        }
                    });
                }
            });
        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            var button = $(this);
            const id = button.data('id');

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("admin/delete") ?>',
                        type: 'POST',
                        data: { 
                            id: id,
                            [csrfName]: csrfHash
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                button.closest('tr').fadeOut('1000', function() {
                                    $(this).remove();
                                    updateRowNumbers(); 
                                });
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data berhasil dihapus.',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal!',
                                    text: 'Gagal menghapus data atau data tidak ditemukan.'
                                });
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan teknis: ' + xhr.statusText
                            });
                        }
                    });
                }
            });
        });
    });
</script>