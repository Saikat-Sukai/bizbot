<template>
    <h2 class="text-base font-semibold leading-7 text-gray-900">Suggestions (click on suggestion to load it):</h2>
    <br/><br/>

    <h6>Module Name:</h6>
    <br/>
    <span @click="click('hola')" class="cursor-pointer inline-flex items-center rounded-md bg-gray-100 px-2 py-1 mr-5 text-xs font-medium text-gray-600">Badge</span>
    <br/><br/>

<!--    <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-yellow-100 px-2 py-1 text-xs font-medium text-yellow-800">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-green-100 px-2 py-1 text-xs font-medium text-green-700">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-blue-100 px-2 py-1 text-xs font-medium text-blue-700">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-indigo-100 px-2 py-1 text-xs font-medium text-indigo-700">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-purple-100 px-2 py-1 text-xs font-medium text-purple-700">Badge</span>-->
<!--    <span class="inline-flex items-center rounded-md bg-pink-100 px-2 py-1 text-xs font-medium text-pink-700">Badge</span>-->
</template>
<script>
    export default {
        methods: {
            click(title) {
                var actionData = {'suggestion':title};
                this.$emit('click', actionData);
            }
        }
    }
</script>
