import Vuex from "vuex";
import Vue from "vue";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [createPersistedState()],

    state: {
        //data
        cart: [], //{product id, product quantity}
        currentCart: [], //cart being currently processed
        total: "",
        currency: {
            code: "LKR",
            exchange_rate: 1.0,
            symbol: "Rs",
        },
        location: "Kandy",
    },

    getters: {
        currentOrder(state) {
            return state.order;
        },

        selectedCurrency(state) {
            return state.currency;
        },

        selectedLocation(state) {
            return state.location;
        },

        cartProducts(state) {
            return state.cart.map((cartItem) => {
                return {
                    id: cartItem.id,
                    title: cartItem.title,
                    base_price: cartItem.base_price,
                    processing_time: cartItem.processing_time,
                    price: cartItem.price,
                    slug: cartItem.slug,
                    user_id: cartItem.user_id,
                    shop: cartItem.shop,
                    shop_image: cartItem.shop_image,
                    category: cartItem.category,
                    image_path: cartItem.image_path,
                    quantity: cartItem.quantity,
                    variations: cartItem.variations,
                    custom_text: cartItem.custom_text,
                };
            });
        },

        cartProductQuantity(state) {
            let totalQuantity = 0;
            state.cart.map((cartItem) => {
                totalQuantity += cartItem.quantity;
            });

            return totalQuantity;
        },

        cartTotal(state) {
            let sum = 0;
            state.cart.map((cartItem) => {
                sum += cartItem.price * cartItem.quantity;
            });

            return sum.toFixed(2);
        },

        shopCartTotal(state) {
            return state.total;
        },

        currentCartProducts(state) {
            return state.currentCart.map((cartItem) => {
                return {
                    id: cartItem.id,
                    title: cartItem.title,
                    base_price: cartItem.base_price,
                    processing_time: cartItem.processing_time,
                    price: cartItem.price,
                    slug: cartItem.slug,
                    shop: cartItem.shop,
                    category: cartItem.category,
                    image_path: cartItem.image_path,
                    quantity: cartItem.quantity,
                    shop_id: cartItem.shop_id,
                    seller_id: cartItem.seller_id,
                    variations: cartItem.variations,
                    custom_text: cartItem.custom_text,
                };
            });
        },

        cartProductsByShop(state) {
            return _.groupBy(state.cart, (cartItem) => cartItem.user_id);
        },
    },

    actions: {
        //currency methods
        saveCurrency(context, currency) {
            context.commit("storeCurrency", currency);
        },

        saveLocation(context, district) {
            context.commit("storeLocation", district);
        },

        //cart methods
        addGiftboxToCart(context, { product, form }) {
            //store giftbox if it exists in state.cart
            const cartItem = context.state.cart.find(
                (item) => item.id === product.id
            );

            //store giftbox product id values passed in from the form
            let giftbox_product_ids_new = product.id;
            for (let key in form.giftbox_product) {
                giftbox_product_ids_new += form.giftbox_product[key].id;
            }

            if (!cartItem) {
                /*
                 *   if giftbox doesn't exist in cart, push to cart
                 */

                context.commit("pushProductToCart", { product, form });
            } else {
                /*
                 *   else check if product ids in the giftbox match
                 *   if yes then increment quantity, else push to cart
                 *   product ids are stored in 'variation_ids' field
                 */

                let cartItemGiftboxProducts = context.state.cart.find(
                    (item) => item.variation_ids === giftbox_product_ids_new
                );

                //custom msg????
                let cartItemCustomMsg = context.state.cart.find(
                    (item) => item.custom_text === form.custom_text
                );

                if (cartItemGiftboxProducts) {
                    context.commit(
                        "incrementItemQuantity",
                        cartItemGiftboxProducts
                    );
                } else {
                    context.commit("pushProductToCart", {
                        product,
                        form,
                    });
                }
            }
        },

        //cart methods
        addProductToCart(context, { product, form }) {
            //pass multiple parameters to an action using destructuring e.g.{ product, form }
            //store product if it exists in state.cart
            const cartItem = context.state.cart.find(
                (item) => item.id === product.id
            );

            //store variation option id values passed in form
            let variation_id_values = "";
            for (let key in form.selected_variations) {
                variation_id_values += form.selected_variations[key].id;
            }

            if (!cartItem) {
                //if product doesn't exist in cart, push to cart
                context.commit("pushProductToCart", { product, form });
            } else {
                //else check if variations match, if yes then increment quantity, else push to cart
                let cartItemVar = context.state.cart.find(
                    (item) => item.variation_ids === variation_id_values
                );
                //custom msg????
                let cartItemCustomMsg = context.state.cart.find(
                    (item) => item.custom_text === form.custom_text
                );

                if (cartItemVar) {
                    context.commit("updateItemQuantity", { cartItemVar, form });
                } else {
                    context.commit("pushProductToCart", {
                        product,
                        form,
                    });
                }
            }
        },

        increaseProductQuantity(context, product) {
            const cartItem = context.state.cart.find(
                (item) => item.variation_ids === product.variation_ids
            );
            if (cartItem.quantity > 0) {
                context.commit("incrementItemQuantity", cartItem);
            }
        },

        removeProductFromCart(context, product) {
            context.commit("deleteProductFromCart", product);
        },

        decreaseProductQuantity(context, product) {
            const cartItem = context.state.cart.find(
                (item) => item.variation_ids === product.variation_ids
            );
            if (cartItem.quantity === 1) {
                context.commit("deleteProductFromCart", product);
            } else {
                context.commit("decrementItemQuantity", cartItem);
            }
        },

        saveShopCartTotal(context, total) {
            context.commit("storeShopCartTotal", total);
        },

        addProductToCurrentCart(context, shop) {
            shop.map((product) => {
                context.commit("pushProductToCurrentCart", product);
            });
        },

        clearOrderedProductFromCart(context) {
            if (context.state.currentCart != []) {
                context.commit("deleteOrderedProductsFromCart");
            }
        },

        refreshPrice(context, updatedProduct) {
            updatedProduct.map((product) => {
                context.state.cart.map((cartProduct) => {
                    if (cartProduct.id === product.id) {
                        context.commit("updateProductPrice", {
                            cartProduct,
                            product,
                        });

                        if (product.has_variations == 1) {
                            product.variation_options.map((option) => {
                                cartProduct.variations.forEach((opt, index) => {
                                    if (opt.id == option.id) {
                                        context.commit(
                                            "updateProductVariationPrice",
                                            {
                                                cartProduct,
                                                opt,
                                                option,
                                            }
                                        );
                                    }
                                });
                            });
                        }
                    }
                });
            });
        },
    },

    mutations: {
        //alter currency state
        storeCurrency(state, currency) {
            state.currency = currency;
        },

        storeLocation(state, district) {
            state.location = district;
        },

        //alter cart state
        pushProductToCart(state, { product, form }) {
            //pass multiple parameters to a mutation using destructuring e.g.{ product, form }

            //store variations
            let variation_values = [];
            //store variation option ids for checking items in cart
            let variation_id_values = "";

            /*
             *  If product is a giftbox (check if category_id == 7)
             *  then push products in the giftbox into variation_values
             *  else push the variations
             */

            if (product.category_id == 7) {
                variation_id_values = product.id;
                for (let key in form.giftbox_product) {
                    variation_values.push({
                        id: form.giftbox_product[key].id,
                        name: form.giftbox_product[key].title,
                        price: form.giftbox_product[key].base_price,
                        quantity: form.giftbox_product[key].quantity,
                        parent: product.id,
                    });
                    variation_id_values += form.giftbox_product[key].id;
                }
            } else {
                for (let key in form.selected_variations) {
                    variation_values.push({
                        id: form.selected_variations[key].id,
                        name: form.selected_variations[key].name,
                        price: form.selected_variations[key].price,
                        parent: form.selected_variations[key].variation.name,
                    });
                    variation_id_values += form.selected_variations[key].id;
                }
            }

            let process_time = "";
            switch (product.processing_time) {
                case "12 hours":
                    process_time = 1;
                    break;
                case "24 hours":
                    process_time = 1;
                    break;
                case "48 hours":
                    process_time = 2;
                    break;
                case "72 hours":
                    process_time = 3;
                    break;
                case "1 week":
                    process_time = 7;
                    break;
                case "2 weeks":
                    process_time = 14;
                    break;
                case "3 weeks":
                    process_time = 21;
                    break;
                case "1 month":
                    process_time = 30;
                    break;
                default:
                    process_time = product.processing_time;
                    break;
            }

            /*
<option>12 hours</option>
<option>24 hours</option>
<option>48 hours</option>
<option>72 hours</option>
<option>1 week</option>
<option>2 weeks</option>
<option>3 weeks</option>
<option>1 month</option>
            */

            state.cart.push({
                id: product.id,
                title: product.title,
                base_price: product.base_price,
                processing_time: process_time,
                price: form.total_price,
                slug: product.slug,
                user_id: product.user_id,
                shop: product.user.shop.name,
                shop_id: product.user.shop.id,
                shop_image: product.user.shop.path,
                category: product.category.name,
                image_path: product.product_image.path,
                quantity: form.quantity,
                variations: variation_values,
                variation_ids: variation_id_values,
                custom_text: form.custom_text,
            });
        },

        pushProductToCurrentCart(state, product) {
            state.currentCart.push({
                id: product.id,
                title: product.title,
                base_price: product.base_price,
                processing_time: product.processing_time,
                price: product.price,
                slug: product.slug,
                shop: product.shop,
                category: product.category,
                image_path: product.image_path,
                quantity: product.quantity,
                shop_id: product.shop_id,
                seller_id: product.user_id,
                variations: product.variations,
                variation_ids: product.variation_ids,
                custom_text: product.custom_text,
            });
        },

        deleteOrderedProductsFromCart(state) {
            //remove the items that have been ordered from the main Cart
            //after this remove items from currenctCart

            state.currentCart.map((product) => {
                let index = state.cart.findIndex((c) => c.id === product.id);

                if (index > -1) {
                    state.cart.splice(index, 1);
                }
            });

            state.currentCart = [];
        },

        deleteProductFromCart(state, product) {
            let index = state.cart.findIndex(
                (c) => c.variation_ids === product.variation_ids
            );

            if (index > -1) {
                state.cart.splice(index, 1);
            }
        },

        incrementItemQuantity(state, cartItem) {
            cartItem.quantity++;
        },

        updateItemQuantity(state, { cartItemVar, form }) {
            cartItemVar.quantity = form.quantity;
        },

        decrementItemQuantity(state, cartItem) {
            cartItem.quantity--;
        },

        storeShopCartTotal(state, total) {
            state.total = total;
        },

        updateProductPrice(state, { cartProduct, product }) {
            cartProduct.base_price = product.base_price;
            cartProduct.price = product.base_price;
        },

        updateProductVariationPrice(state, { cartProduct, opt, option }) {
            opt.price = option.price;

            let variationSum = 0;
            cartProduct.variations.map((v) => {
                variationSum += parseFloat(v.price);
            });

            cartProduct.price = (
                parseFloat(cartProduct.base_price) + parseFloat(variationSum)
            ).toFixed(2);
        },
    },
});
