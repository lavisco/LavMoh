export let routes = [
    /*
     ** Admin Routes
     */
    {
        path: "/admin/dashboard",
        component: require("./components/admin/Dashboard.vue").default,
        meta: {
            title: "Dashboard",
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
        path: "/admin/materials",
        component: require("./components/admin/Material.vue").default,
        meta: {
            title: "Materials",
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
        path: "/admin/products/listing/image/:productId",
        name: "admin/products/listing/image/edit",
        component: require("./components/admin/ProductImageEdit.vue").default,
        meta: {
            title: "Product Listing Image Edit",
        },
    },
    {
        path: "/admin/products/listing/variation/:productId",
        name: "admin/products/listing/variation/edit",
        component: require("./components/admin/ProductVariationEdit.vue")
            .default,
        meta: {
            title: "Product Listing Variation Edit",
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
        path: "/admin/product_images",
        component: require("./components/admin/ProductImage.vue").default,
        meta: {
            title: "Product Images",
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
        path: "/admin/variations",
        component: require("./components/admin/Variation.vue").default,
        meta: {
            title: "Variations",
        },
    },
    {
        path: "/admin/variation_options",
        component: require("./components/admin/VariationOption.vue").default,
        meta: {
            title: "Variation Options",
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
        path: "/admin/users",
        component: require("./components/admin/User.vue").default,
        meta: {
            title: "Users",
        },
    },

    /*
     ** Buyer Routes
     */
    {
        path: "/buyer/dashboard",
        component: require("./components/buyer/Dashboard.vue").default,
        meta: {
            title: "Your Profile",
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
     ** Seller Routes
     */
    {
        path: "/seller/dashboard",
        component: require("./components/seller/Dashboard.vue").default,
        meta: {
            title: "Seller Dashboard",
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
            title: "Product Listing",
        },
    },
    {
        path: "/seller/products/listing/:productId",
        name: "seller/products/listing/edit",
        component: require("./components/seller/ProductListingEdit.vue")
            .default,
        meta: {
            title: "Product Listing Edit",
        },
    },
    {
        path: "/seller/products/listing/image/:productId",
        name: "seller/products/listing/image/edit",
        component: require("./components/seller/ProductImageEdit.vue").default,
        meta: {
            title: "Product Listing Image Edit",
        },
    },
    {
        path: "/seller/products/listing/variation/:productId",
        name: "seller/products/listing/variation/edit",
        component: require("./components/seller/ProductVariationEdit.vue")
            .default,
        meta: {
            title: "Product Listing Variation Edit",
        },
    },
    {
        path: "/seller/product_images",
        component: require("./components/seller/ProductImage.vue").default,
        meta: {
            title: "Product Images",
        },
    },
    {
        path: "/seller/product_variations",
        component: require("./components/seller/ProductVariation.vue").default,
        meta: {
            title: "Product Variation",
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
        path: "/seller/orders",
        component: require("./components/seller/Order.vue").default,
        meta: {
            title: "Orders",
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
            title: "Your Shop",
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
        path: "/seller/statistics",
        component: require("./components/seller/Statistics.vue").default,
        meta: {
            title: "Statistics",
        },
    },

    /*
     ** Website Routes
     */

    {
        path: "/lavisco/home",
        name: "index",
        component: require("./components/Index.vue").default,
        meta: {
            title: "Lavisco",
        },
    },
    {
        path: "/lavisco/products",
        name: "products",
        component: require("./components/Products.vue").default,
        meta: {
            title: "Products",
        },
    },
    {
        path: "/lavisco/products/:productId",
        name: "products/product",
        component: require("./components/Product.vue").default,
        meta: {
            title: "Product",
        },
    },
    {
        path: "/lavisco/categories",
        name: "categories",
        component: require("./components/Categories.vue").default,
        meta: {
            title: "Categories",
        },
    },
    {
        path: "/lavisco/categories/:categoryId",
        name: "categories/category",
        component: require("./components/Category.vue").default,
        meta: {
            title: "Category",
        },
    },
    {
        path: "/lavisco/occasions",
        name: "occasions",
        component: require("./components/Occasions.vue").default,
        meta: {
            title: "Occasions",
        },
    },
    {
        path: "/lavisco/occasions/:occasionId",
        name: "occasions/occasion",
        component: require("./components/Occasion.vue").default,
        meta: {
            title: "Occasion",
        },
    },
    {
        path: "/lavisco/recipients",
        name: "recipients",
        component: require("./components/Recipients.vue").default,
        meta: {
            title: "Recipients",
        },
    },
    {
        path: "/lavisco/recipients/:recipientId",
        name: "recipients/recipient",
        component: require("./components/Recipient.vue").default,
        meta: {
            title: "Recipient",
        },
    },
    {
        path: "/lavisco/cart",
        name: "cart",
        component: require("./components/Cart.vue").default,
        meta: {
            title: "Cart",
        },
    },
    {
        path: "/lavisco/shipping",
        name: "shipping",
        component: require("./components/Shipping.vue").default,
        meta: {
            title: "Shipping",
        },
    },
    {
        path: "/lavisco/sellers",
        name: "sellers",
        component: require("./components/Sellers.vue").default,
        meta: {
            title: "Sellers",
        },
    },
    {
        path: "/lavisco/sellers/:shopId",
        name: "sellers/seller",
        component: require("./components/Seller.vue").default,
        meta: {
            title: "Seller",
        },
    },
    {
        path: "/lavisco/seller/onboard",
        name: "seller/onboard",
        component: require("./components/SellerOnboard.vue").default,
        meta: {
            title: "Seller Onboarding",
        },
    },
    {
        path: "/lavisco/seller/register",
        component: require("./components/SellerRegister.vue").default,
        meta: {
            title: "Seller Registration",
        },
    },
];
