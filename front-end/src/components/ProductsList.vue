<template>
  <div class="m-8">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-semibold">Products</h1>
      <router-link
        to="/product/create"
        class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded"
      >
        Add
      </router-link>
    </div>

    <div class="flex justify-between mt-4">
      <div class="mb-4">
        <label for="categoryFilter" class="block text-gray-700"
          >Filter by Category:</label
        >
        <select
          id="categoryFilter"
          v-model="selectedCategory"
          @change="getProducts"
          class="block w-full mt-2 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-500"
        >
          <option value="">All Categories</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
      </div>

      <div class="mb-4">
        <label for="priceSort" class="block text-gray-700">Sort by Price:</label>
        <select
          id="priceSort"
          v-model="selectedSort"
          @change="getProducts"
          class="block w-full mt-2 py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:border-blue-500"
        >
          <option value="asc">Lowest to Highest</option>
          <option value="desc">Highest to Lowest</option>
        </select>
      </div>
    </div>

    <div class="grid grid-cols-4 gap-4">
      <ProductVue v-for="product in products" :key="product.id" :product="product" />
    </div>
  </div>
</template>

<script setup>
import axios from "axios";
import { onMounted, ref } from "vue";
import ProductVue from "./ProductVue.vue";

const products = ref([]);
const selectedCategory = ref("");
const selectedSort = ref("asc");
const categories = ref([]);

const getProducts = async () => {
  axios
    .get("http://localhost:8000/api/products", {
      params: {
        category_id: selectedCategory.value,
        sort_order: selectedSort.value,
      },
    })
    .then((resp) => {
      products.value = resp.data.data;
    })
    .catch((error) => {
      alert("Something went wrong", error);
    });
};

const getCategories = async () => {
  axios
    .get("http://localhost:8000/api/categories", {})
    .then((resp) => {
      categories.value = resp.data.data;
    })
    .catch((error) => {
      alert("Something went wrong", error);
    });
};

onMounted(() => {
  getProducts();
  getCategories();
});
</script>

<style>
</style>
