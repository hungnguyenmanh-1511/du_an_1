<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Dashboard | NN Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CSS -->
    <?php require_once "views/layouts/libs_css.php"; ?>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- HEADER -->
        <?php
        require_once "views/layouts/header.php";
        require_once "views/layouts/siderbar.php";
        ?>

        <!-- Left Sidebar End -->
        <div class="vertical-overlay"></div>


        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Quản lý đơn hàng</h4>
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                                        <li class="breadcrumb-item active">Đơn hàng</li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">

                        <div class="col">
                            <div class="h-100">
                                <div class="row mb-4">
                                    <form action="?act=tim-kiem-don-hang" method="POST" class="d-flex align-items-center">
                                        <div class="col-auto">
                                            <input name="key" class="search form-control form-control-sm me-2"
                                                placeholder="Search" style="width: 200px;"
                                                value="<?= isset($_POST['key']) ? htmlspecialchars($_POST['key']) : '' ?>" />
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-primary btn-sm" data-sort="name">
                                                Tìm kiếm
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <!-- Card for Orders Table -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="live-preview">
                                            <div class="table-responsive table-card">
                                                <table class="table align-middle table-nowrap table-striped-columns mb-0">
                                                    <thead class="table-light">
                                                        <tr>
                                                            <th scope="col" style="width: 46px;">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        value="" id="cardtableCheck">
                                                                    <label class="form-check-label"
                                                                        for="cardtableCheck"></label>
                                                                </div>
                                                            </th>
                                                            <th scope="col">STT</th>
                                                            <th scope="col">Mã Đơn Hàng</th>
                                                            <th scope="col">Tên người nhận</th>
                                                            <th scope="col">SĐT</th>
                                                            <th scope="col">Ngày đặt</th>
                                                            <th scope="col">Trạng thái đơn hàng</th>
                                                            <th scope="col">Trạng thái thanh toán</th>
                                                            <th scope="col">Chi tiết</th>


                                                            <th scope="col" style="width: 150px;">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        if (!isset($listDonHang)) {
                                                            $listDonHang = [];
                                                        }

                                                        if (isset($resultSearchOrder) && !empty($resultSearchOrder)) {
                                                            $dataToDisplay = $resultSearchOrder;
                                                        } else {

                                                            $dataToDisplay = $listDonHang;
                                                        }

                                                        if (is_array($dataToDisplay) && count($dataToDisplay) > 0) { ?>
                                                            <?php foreach ($dataToDisplay as $index => $row): ?>
                                                                <tr>
                                                                    <td>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox"
                                                                                value="" id="cardtableCheck<?= $index ?>">
                                                                            <label class="form-check-label"
                                                                                for="cardtableCheck<?= $index ?>"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td><a href="#" class="fw-medium"><?= $index + 1 ?></a></td>
                                                                    <td><?= htmlspecialchars($row['ma_don_hang']) ?></td>
                                                                    <td><?= htmlspecialchars($row['ten_nguoi_nhan']) ?></td>
                                                                    <td><?= htmlspecialchars($row['sdt_nguoi_nhan']) ?></td>
                                                                    <td><?= htmlspecialchars($row['ngay_dat']) ?></td>
                                                                    <td><select name="" id="trangthai" class="form-control" data-id="<?= $row['id'] ?>">
                                                                            <?php foreach ($trangthai as $item): ?>

                                                                                <option value="<?= $item['id'] ?>"  <?= ($row['trang_thai_id'] >= 6 && $item['id'] == 11) ? 'disabled' : '' ?>  <?= ($row['trang_thai_id'] == 9 && $item['id'] == 11) ? 'disabled' : '' ?> <?= (intval($row['trang_thai_id']) > intval($item['id'])) ? 'disabled' : '' ?> <?= ($row['trang_thai_id'] == $item['id']) ? "selected" : "" ?>><?= $item['ten_trang_thai_id'] ?></option>


                                                                            <?php endforeach ?>
                                                                        </select></td>
                                                                    <td><?php if ($row['trang_thai_thanh_toan_id'] == 1) {
                                                                            echo 'Đã thanh toán';
                                                                        } elseif ($row['trang_thai_thanh_toan_id'] == 2) {
                                                                            echo 'Chưa thanh toán';
                                                                        } elseif ($row['trang_thai_thanh_toan_id'] == 3) {
                                                                            echo "Đang xử lí";
                                                                        }

                                                                        ?>
                                                                    </td>




                                                                    <td>
                                                                        <div class="col-xl-3 col-lg-4 col-sm-6">
                                                                            <a
                                                                                href="?act=chi-tiet-don-hang&id=<?= $row['id'] ?>">
                                                                                <i data-feather="eye" class="text-primary"></i>
                                                                                <!-- Biểu tượng mắt -->
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="hstack gap-3 flex-wrap">
                                                                            <a href="?act=form-sua-don-hang&id=<?= $row['id'] ?>"
                                                                                class="link-success fs-15"><i
                                                                                    class="ri-edit-2-line"></i></a>

                                                                            <form action="?act=xoa-don-hang" method="POST"
                                                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                                                <input type="hidden" name="don-hang-id"
                                                                                    value="<?= $row['id'] ?>">
                                                                                <button type="submit" class="link-danger fs-15" style="border: none;">
                                                                                    <i class="ri-delete-bin-line"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        <?php } else { ?>
                                                            <tr>
                                                                <td colspan="10" class="text-center">Không có kết quả nào
                                                                    được tìm thấy.</td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div><!-- end card-body -->
                                </div><!-- end card -->
                            </div> <!-- end .h-100-->
                        </div> <!-- end col -->
                    </div>
                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Velzon.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <?php require_once "views/layouts/libs_js.php"; ?>

    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            feather.replace();
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script type="module">
        const status = document.querySelectorAll('#trangthai');
        for (const element of status) {
            element.addEventListener('change', (e) => {
                const value = e.target.value;
                const id = element.dataset.id;


                $.ajax({
                    url: "http://localhost/du_an_1/admin/?act=update-order",
                    method: "GET",
                    data: {
                        value: value,
                        id: id
                    },
                    success: function(response) {

                        Swal.fire({
                            title: "Thành công !",
                            text: "Cập nhật trạng thái thành công ",
                            icon: "success"
                        }).then(function() {
                            window.location.reload();
                        });


                    }

                });

            })
        }
    </script>
</body>

</html>