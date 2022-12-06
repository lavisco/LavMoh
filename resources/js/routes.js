export let routes = [
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */

    {
        path: "/admin/analytics",
        component: require("./components/admin/Analytics.vue").default,
        meta: {
            title: "Analytics",
        },
    },
    {
        path: "/admin/areas",
        component: require("./components/admin/Area.vue").default,
        meta: {
            title: "Area",
        },
    },
    {
        path: "/admin/buyerprofiles",
        component: require("./components/admin/BuyerProfile.vue").default,
        meta: {
            title: "Buyer Profiles",
        },
    },
    {
        path: "/admin/categories",
        component: require("./components/admin/Category.vue").default,
        meta: {
            title: "Product Natures",
        },
    },
    {
        path: "/admin/carts",
        component: require("./components/admin/Cart.vue").default,
        meta: {
            title: "Carts",
        },
    },
    {
        path: "/admin/cities",
        component: require("./components/admin/City.vue").default,
        meta: {
            title: "City",
        },
    },
    {
        path: "/admin/countries",
        component: require("./components/admin/Country.vue").default,
        meta: {
            title: "Country",
        },
    },
    {
        path: "/admin/currencies",
        component: require("./components/admin/Currency.vue").default,
        meta: {
            title: "Currency",
        },
    },
    {
        path: "/admin/dashboard",
        component: require("./components/admin/Dashboard.vue").default,
        meta: {
            title: "Dashboard",
        },
    },
    {
        path: "/admin/districts",
        component: require("./components/admin/District.vue").default,
        meta: {
            title: "District",
        },
    },
    {
        path: "/admin/documents",
        component: require("./components/admin/DocumentExporter.vue").default,
        meta: {
            title: "Documents",
        },
    },
    {
        path: "/admin/giftboxes",
        component: require("./components/admin/Giftbox.vue").default,
        meta: {
            title: "Giftboxes",
        },
    },
    {
        path: "/admin/giftboxes/listing",
        component: require("./components/admin/GiftboxListing.vue").default,
        meta: {
            title: "New Giftbox",
        },
    },
    {
        path: "/admin/giftboxes/listing/:productId",
        name: "admin/giftboxes/listing/edit",
        component: require("./components/admin/GiftboxListingEdit.vue").default,
        meta: {
            title: "Edit Giftbox",
        },
    },
    {
        path: "/admin/giftwraps",
        component: require("./components/admin/Giftwrap.vue").default,
        meta: {
            title: "Giftwraps",
        },
    },
    {
        path: "/admin/homesliders",
        component: require("./components/admin/HomeSlider.vue").default,
        meta: {
            title: "Home Sliders",
        },
    },
    {
        path: "/admin/occasions",
        component: require("./components/admin/Occasion.vue").default,
        meta: {
            title: "Occasions",
        },
    },
    {
        path: "/admin/orders",
        component: require("./components/admin/Order.vue").default,
        meta: {
            title: "Orders",
        },
    },
    {
        path: "/admin/orderstates",
        component: require("./components/admin/OrderState.vue").default,
        meta: {
            title: "Order States",
        },
    },
    {
        path: "/admin/permissions",
        component: require("./components/admin/Permission.vue").default,
        meta: {
            title: "Permissions",
        },
    },
    {
        path: "/admin/products",
        name: "admin/products",
        component: require("./components/admin/Product.vue").default,
        meta: {
            title: "Products",
        },
    },
    {
        path: "/admin/products/listing",
        component: require("./components/admin/ProductListing.vue").default,
        meta: {
            title: "Product Listing",
        },
    },
    {
        path: "/admin/products/listing/:productId",
        name: "admin/products/listing/edit",
        component: require("./components/admin/ProductListingEdit.vue").default,
        meta: {
            title: "Product Listing Edit",
        },
    },
    {
        path: "/admin/products/listing/variations",
        component: require("./components/admin/ProductVariation.vue").default,
        meta: {
            title: "Product Variations",
        },
    },
    {
        path: "/admin/productstates",
        component: require("./components/admin/ProductState.vue").default,
        meta: {
            title: "Product States",
        },
    },
    {
        path: "/admin/provinces",
        component: require("./components/admin/Province.vue").default,
        meta: {
            title: "Province",
        },
    },
    {
        path: "/admin/product_videos",
        component: require("./components/admin/ProductVideo.vue").default,
        meta: {
            title: "Product Videos",
        },
    },
    {
        path: "/admin/receipts",
        component: require("./components/admin/Receipt.vue").default,
        meta: {
            title: "Receipts",
        },
    },
    {
        path: "/admin/recipients",
        component: require("./components/admin/Recipient.vue").default,
        meta: {
            title: "Recipients",
        },
    },
    {
        path: "/admin/roles",
        component: require("./components/admin/Role.vue").default,
        meta: {
            title: "Roles",
        },
    },
    {
        path: "/admin/sellerprofiles",
        component: require("./components/admin/SellerProfile.vue").default,
        meta: {
            title: "Seller Profiles",
        },
    },
    {
        path: "/admin/settings",
        component: require("./components/admin/Setting.vue").default,
        meta: {
            title: "Setting",
        },
    },
    {
        path: "/admin/shippings",
        component: require("./components/admin/Shipping.vue").default,
        meta: {
            title: "Shipping Types",
        },
    },
    {
        path: "/admin/shops",
        component: require("./components/admin/Shop.vue").default,
        meta: {
            title: "Shops",
        },
    },
    {
        path: "/admin/sitetexts",
        component: require("./components/admin/Sitetext.vue").default,
        meta: {
            title: "Site Content",
        },
    },
    {
        path: "/admin/subcategories",
        component: require("./components/admin/SubCategory.vue").default,
        meta: {
            title: "Sub Categories",
        },
    },
    {
        path: "/admin/topproducts",
        name: "admin/topproducts",
        component: require("./components/admin/TopProduct.vue").default,
        meta: {
            title: "Top Products",
        },
    },
    {
        path: "/admin/transactions",
        component: require("./components/admin/Transaction.vue").default,
        meta: {
            title: "Transactions",
        },
    },
    {
        path: "/admin/users",
        component: require("./components/admin/User.vue").default,
        meta: {
            title: "Users",
        },
    },

    /*
    |--------------------------------------------------------------------------
    | Buyer Routes
    |--------------------------------------------------------------------------
    */

    {
        path: "/buyer/dashboard",
        component: require("./components/buyer/Dashboard.vue").default,
        meta: {
            title: "Overview",
        },
    },
    {
        path: "/buyer/buyerprofile",
        component: require("./components/buyer/BuyerProfile.vue").default,
        meta: {
            title: "Your Profile",
        },
    },
    {
        path: "/buyer/orders",
        component: require("./components/buyer/Order.vue").default,
        meta: {
            title: "Order History",
        },
    },
    {
        path: "/buyer/messages",
        component: require("./components/buyer/Message.vue").default,
        meta: {
            title: "Messages",
        },
    },

    /*
    |--------------------------------------------------------------------------
    | Seller Routes
    |--------------------------------------------------------------------------
    */

    {
        path: "/seller/custom_product_inquiries",
        component: require("./components/seller/CustomProductInquiry.vue")
            .default,
        meta: {
            title: "Custom Requests",
        },
    },
    {
        path: "/seller/dashboard",
        component: require("./components/seller/Dashboard.vue").default,
        meta: {
            title: "Dashboard",
        },
    },
    {
        path: "/seller/giftboxes",
        component: require("./components/seller/Giftbox.vue").default,
        meta: {
            title: "Giftboxes",
        },
    },
    {
        path: "/seller/giftboxes/listing",
        component: require("./components/seller/GiftboxListing.vue").default,
        meta: {
            title: "New Giftbox",
        },
    },
    {
        path: "/seller/giftboxes/listing/:productId",
        name: "seller/giftboxes/listing/edit",
        component: require("./components/seller/GiftboxListingEdit.vue")
            .default,
        meta: {
            title: "Edit Giftbox",
        },
    },
    {
        path: "/seller/messages",
        component: require("./components/seller/Message.vue").default,
        meta: {
            title: "Messages",
        },
    },
    {
        path: "/seller/password_reset",
        component: require("./components/seller/PasswordReset.vue").default,
        meta: {
            title: "Password Reset",
        },
    },
    {
        path: "/seller/products",
        component: require("./components/seller/Product.vue").default,
        meta: {
            title: "Products",
        },
    },
    {
        path: "/seller/products/listing",
        component: require("./components/seller/ProductListing.vue").default,
        meta: {
            title: "New Product",
        },
    },
    {
        path: "/seller/products/listing/:productId",
        name: "seller/products/listing/edit",
        component: require("./components/seller/ProductListingEdit.vue")
            .default,
        meta: {
            title: "Edit Product",
        },
    },
    {
        path: "/seller/product_videos",
        component: require("./components/seller/ProductVideo.vue").default,
        meta: {
            title: "Product Videos",
        },
    },
    {
        path: "/seller/sellerprofile",
        component: require("./components/seller/SellerProfile.vue").default,
        meta: {
            title: "Your Account",
        },
    },
    {
        path: "/seller/shop",
        component: require("./components/seller/Shop.vue").default,
        meta: {
            title: "Your Store",
        },
    },
    {
        path: "/seller/shop_setup",
        component: require("./components/seller/ShopSetup.vue").default,
        meta: {
            title: "Setup Your Shop",
        },
    },
    {
        path: "/seller/statistics",
        component: require("./components/seller/Statistics.vue").default,
        meta: {
            title: "Statistics",
        },
    },
    {
        path: "/seller/transactions",
        component: require("./components/seller/Transaction.vue").default,
        meta: {
            title: "Transactions",
        },
    },
    {
        path: "/seller/orders",
        component: require("./components/seller/Order.vue").default,
        meta: {
            title: "Order",
        },
    },

    /*
    |--------------------------------------------------------------------------
    | Website Routes
    |--------------------------------------------------------------------------
    */

    {
        path: "/",
        name: "index",
        component: require("./components/website/Index.vue").default,
        meta: {
            title: "Lavisco",
        },
    },
    {
        //employee or admin login
        path: "/employee/login",
        name: "employee/login",
        component: require("./components/website/auth/EmployeeLogin.vue")
            .default,
        meta: {
            title: "Employee Login",
        },
    },
    {
        //seller login
        path: "/merchant/login",
        name: "merchant/login",
        component: require("./components/website/auth/MerchantLogin.vue")
            .default,
        meta: {
            title: "Merchant Login",
        },
    },
    {
        //buyer login
        path: "/login",
        name: "/login",
        component: require("./components/website/auth/BuyerLogin.vue").default,
        meta: {
            title: "Login",
        },
    },
    {
        //login selection page
        path: "/select_login",
        name: "select_login",
        component: require("./components/website/auth/LoginSelection.vue")
            .default,
        meta: {
            title: "Select Login",
        },
    },
    {
        //password reset
        path: "/reset_password",
        name: "reset_password",
        component: require("./components/website/auth/PasswordReset.vue")
            .default,
        meta: {
            title: "Reset Password",
        },
    },
    {
        path: "/about",
        name: "about",
        component: require("./components/website/static/AboutUs.vue").default,
        meta: {
            title: "About Us",
        },
    },
    {
        path: "/cart",
        name: "cart",
        component: require("./components/website/Cart.vue").default,
        meta: {
            title: "Cart",
        },
    },
    {
        path: "/categories",
        name: "categories",
        component: require("./components/website/Categories.vue").default,
        meta: {
            title: "Categories",
        },
    },
    {
        path: "/categories/:categoryId/:location/:slug",
        name: "categories/category",
        component: require("./components/website/Category.vue").default,
        meta: {
            title: "Category",
        },
    },
    {
        path: "/coming_soon",
        name: "coming_soon",
        component: require("./components/website/static/ComingSoon.vue")
            .default,
        meta: {
            title: "Coming Soon",
        },
    },
    {
        path: "/contact_us",
        name: "contact_us",
        component: require("./components/website/static/ContactUs.vue").default,
        meta: {
            title: "Contact Us",
        },
    },
    {
        path: "/custom_product_inquiry/:productId",
        name: "custom_product_inquiry",
        component: require("./components/website/CustomProductForm.vue")
            .default,
        meta: {
            title: "Custom Cake Request",
        },
    },
    {
        path: "/faq",
        name: "faq",
        component: require("./components/website/static/Faq.vue").default,
        meta: {
            title: "FAQ",
        },
    },
    {
        path: "/giftboxes/:productId/:slug",
        name: "giftboxes/product",
        component: require("./components/website/GiftboxBuilder.vue").default,
        meta: {
            title: "Giftbox Builder",
        },
    },
    {
        path: "/products",
        name: "products",
        component: require("./components/website/Products.vue").default,
        meta: {
            title: "Products",
        },
    },
    {
        path: "/products/:productId/:location/:slug",
        name: "products/product",
        component: require("./components/website/Product.vue").default,
        meta: {
            title: "Product",
        },
    },
    {
        path: "/occasions",
        name: "occasions",
        component: require("./components/website/Occasions.vue").default,
        meta: {
            title: "Occasions",
        },
    },
    {
        path: "/occasions/:occasionId/:location/:slug",
        name: "occasions/occasion",
        component: require("./components/website/Occasion.vue").default,
        meta: {
            title: "Occasion",
        },
    },
    {
        path: "/order/:orderCode",
        name: "order_detail",
        component: require("./components/website/OrderDetail.vue").default,
        meta: {
            title: "Order Detail",
        },
    },
    {
        path: "/recipients",
        name: "recipients",
        component: require("./components/website/Recipients.vue").default,
        meta: {
            title: "Recipients",
        },
    },
    {
        path: "/recipients/:recipientId/:location/:slug",
        name: "recipients/recipient",
        component: require("./components/website/Recipient.vue").default,
        meta: {
            title: "Recipient",
        },
    },
    {
        path: "/register",
        name: "register",
        component: require("./components/website/auth/Register.vue").default,
        meta: {
            title: "Registration",
        },
    },
    {
        path: "/results/:searchText",
        name: "results",
        props: true,
        component: require("./components/website/SearchResultsPage.vue")
            .default,
        meta: {
            title: "Search Results",
        },
    },
    {
        path: "/sitemap",
        name: "sitemap",
        component: require("./components/website/static/Sitemap.vue").default,
        meta: {
            title: "Sitemap",
        },
    },
    {
        path: "/sellers",
        name: "sellers",
        component: require("./components/website/Sellers.vue").default,
        meta: {
            title: "Sellers",
        },
    },
    {
        path: "/shop/:shopId/:location/:slug",
        name: "shop",
        component: require("./components/website/Seller.vue").default,
        meta: {
            title: "Seller",
        },
    },
    {
        path: "/sell_on_lavisco",
        name: "sell_on_lavisco",
        component: require("./components/website/static/SellerOnboard.vue")
            .default,
        meta: {
            title: "Seller Onboarding",
        },
    },
    {
        path: "/seller_register",
        name: "seller_register",
        component: require("./components/website/auth/SellerRegister.vue")
            .default,
        meta: {
            title: "Seller Registration",
        },
    },
    {
        path: "/sub_category/:subCategoryId/:location/:slug",
        name: "sub_category",
        component: require("./components/website/SubCategory.vue").default,
        meta: {
            title: "Sub Category",
        },
    },

    

    /*
     Website Policies Routes
    */

    {
        path: "/terms_and_conditions",
        name: "terms_and_conditions",
        component:
            require("./components/website/policy/PolicyTermsConditions.vue")
                .default,
        meta: {
            title: "Terms And Conditions",
        },
    },
    {
        path: "/privacy_policy",
        name: "privacy_policy",
        component: require("./components/website/policy/PolicyPrivacy.vue")
            .default,
        meta: {
            title: "Privacy Policy",
        },
    },
    {
        path: "/returns_refunds_policy",
        name: "returns_refunds_policy",
        component:
            require("./components/website/policy/PolicyReturnsRefunds.vue")
                .default,
        meta: {
            title: "Returns & Refunds Policy",
        },
    },
    {
        path: "/delivery_policy",
        name: "delivery_policy",
        component: require("./components/website/policy/PolicyDelivery.vue")
            .default,
        meta: {
            title: "Delivery Policy",
        },
    },
    {
        path: "/cookie_policy",
        name: "cookie_policy",
        component: require("./components/website/policy/PolicyCookie.vue")
            .default,
        meta: {
            title: "Cookie Policy",
        },
    },
    {
        path: "/payment_policy",
        name: "payment_policy",
        component: require("./components/website/policy/PolicyPayment.vue")
            .default,
        meta: {
            title: "Payment Policy",
        },
    },

    /*
     Blank route titles
    */

    {
        path: "/payment",
        meta: {
            title: "Checkout",
        },
    },

    {
        path: "/payment/response",
        meta: {
            title: "Order Confirmed",
        },
    },

    {
        path: "/password/reset/*",
        meta: {
            title: "Password Reset",
        },
    },
    {
        path: "/password/reset",
        meta: {
            title: "Password Reset",
        },
    },

    /*
     404 Page not Found
    */

    {
        path: "*",
        name: "404",
        component: require("./components/website/static/NotFound.vue").default,
        meta: {
            title: "404 Page Not Found",
        },
    },
];
