import Vuex from "vuex";
import Vue from "vue";

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        //data
        cart: [], //{product id, product quantity}
        currentCart: [], //cart being currently processed
        total: "",
    },

    getters: {
        cartProducts(state) {
            return state.cart.map((cartItem) => {
                return {
                    id: cartItem.id,
                    title: cartItem.title,
                    base_price: cartItem.base_price,
                    price: cartItem.price,
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
                    price: cartItem.price,
                    shop: cartItem.shop,
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
        //methods
        addProductToCart(context, { product, productForm }) {
            //pass multiple parameters to an action using destructuring e.g.{ product, productForm }
            //store product if it exists in state.cart
            const cartItem = context.state.cart.find(
                (item) => item.id === product.id
            );

            //store variation option id values passed in productForm
            let variation_id_values = "";
            for (let key in productForm.selected_variations) {
                variation_id_values += productForm.selected_variations[key].id;
            }

            if (!cartItem) {
                //if product doesn't exist in cart, push to cart
                context.commit("pushProductToCart", { product, productForm });
            } else {
                //else check if variations match, if yes then increment quantity, else push to cart
                let cartItemVar = context.state.cart.find(
                    (item) => item.variation_ids === variation_id_values
                );
                //custom msg????
                let cartItemCustomMsg = context.state.cart.find(
                    (item) => item.custom_text === productForm.custom_text
                );

                if (cartItemVar) {
                    context.commit("incrementItemQuantity", cartItemVar);
                } else {
                    context.commit("pushProductToCart", {
                        product,
                        productForm,
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

        emptyCurrentCart(context) {
            if (context.state.currentCart != []) {
                context.commit("deleteAllProductsFromCurrentCart");
            }
        },
    },

    mutations: {
        //alter state
        pushProductToCart(state, { product, productForm }) {
            //pass multiple parameters to a mutation using destructuring e.g.{ product, productForm }

            //store variations
            let variation_values = [];
            //store variation option ids for checking items in cart
            let variation_id_values = "";
            for (let key in productForm.selected_variations) {
                variation_values.push({
                    id: productForm.selected_variations[key].id,
                    name: productForm.selected_variations[key].name,
                    price: productForm.selected_variations[key].price,
                    parent: productForm.selected_variations[key].variation.name,
                });
                variation_id_values += productForm.selected_variations[key].id;
            }

            state.cart.push({
                id: product.id,
                title: product.title,
                base_price: product.base_price,
                price: productForm.total_price,
                user_id: product.user_id,
                shop: product.user.shop.name,
                shop_id: product.user.shop.id,
                shop_image: product.user.shop.path,
                category: product.category.name,
                image_path: product.product_image.path,
                quantity: 1,
                variations: variation_values,
                variation_ids: variation_id_values,
                custom_text: productForm.custom_text,
            });
        },

        pushProductToCurrentCart(state, product) {
            state.currentCart.push({
                id: product.id,
                title: product.title,
                base_price: product.base_price,
                price: product.price,
                shop: product.shop,
                image_path: product.image_path,
                quantity: product.quantity,
                shop_id: product.shop_id,
                seller_id: product.user_id,
                variations: product.variations,
                variation_ids: product.variation_ids,
                custom_text: product.custom_text,
            });
        },

        deleteAllProductsFromCurrentCart(state) {
            state.currentCart = [];
        },

        incrementItemQuantity(state, cartItem) {
            cartItem.quantity++;
        },

        decrementItemQuantity(state, cartItem) {
            cartItem.quantity--;
        },

        storeShopCartTotal(state, total) {
            state.total = total;
        },

        deleteProductFromCart(state, product) {
            let index = state.cart.findIndex(
                (c) => c.variation_ids === product.variation_ids
            );

            if (index > -1) {
                state.cart.splice(index, 1);
            }
        },
    },
});
