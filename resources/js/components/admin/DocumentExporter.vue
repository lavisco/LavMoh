<template>
    <div>
        <!-- Body -->
        <div class="container-fluid mt-3 mb-5">
            <div class="card shadow mb-4">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">Users Excel Files</h4>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center px-4 pb-4">
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelUsers"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        All Users
                    </button>
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelBuyer"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        Buyers
                    </button>
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelSeller"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        Seller Users
                    </button>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">Products Excel Files</h4>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center px-4 pb-4">
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelProduct"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        Products
                    </button>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">Orders Excel Files</h4>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center px-4 pb-4">
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelOrder"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        Orders
                    </button>
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelTransaction"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        Transactions
                    </button>
                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">Shop Excel Files</h4>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center px-4 pb-4">
                    <button
                        class="btn btn-neutral mr-2"
                        type="button"
                        @click="exportExcelShop"
                    >
                        <i class="fas fa-file-download mr-2"></i>
                        Shop
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({}),

    methods: {
        exportExcelUsers() {
            window.open(`/export/users`, "_blank");
        },
        exportExcelBuyer() {
            window.open(`/export/users/buyer`, "_blank");
        },

        exportExcelSeller() {
            window.open(`/export/users/seller`, "_blank");
        },

        exportExcelOrder() {
            window.open(`/export/orders`, "_blank");
        },

        exportExcelProduct() {
            window.open(`/export/products`, "_blank");
        },

        exportExcelShop() {
            window.open(`/export/shops`, "_blank");
        },

        exportExcelTransaction() {
            window.open(`/export/transactions`, "_blank");
        },
    },

    mounted() {},
};
</script>
