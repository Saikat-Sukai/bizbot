<template>
    <h1 class="text-base font-semibold leading-7">Create Wordpress Post: Step #{{data.step}}</h1>

    <div v-show="data.step==1">
        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-12">
                <label for="post_title" class="block text-sm font-medium leading-6 text-gray-900">Title of the Post :</label>
                <div class="mt-2">
                    <input type="text" name="post_title" id="post_title" ref="post_title" autocomplete="post_title" class="block w-full rounded-md border-0 px-3 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="title"/>
                </div>
            </div>
            <div class="col-span-12">
                <label for="post_excerpt" class="block text-sm font-medium leading-6 text-gray-900">Excerpt of the Post :</label>
                <div class="mt-2">
                    <textarea rows="3" name="post_excerpt" id="post_excerpt" ref="post_excerpt" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" v-model="excerpt" ></textarea>
                </div>
            </div>
            <div class="col-span-12">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">
                    Content of the Post :
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <a @click.prevent="action('enhance-ai')" class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">Enhance (AI)</a>
                    &nbsp;&nbsp;
                    <a @click.prevent="action('enhance-gig')" class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">Enhance ($5 Gig)</a>
                    <!--                    <button @click="action('enhance')" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enhance using GPT</button>-->
                    <!--                    <button @click="action('enhance')" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Enhance using GPT</button>-->
                </label>
                <div class="mt-2">
                    <editor
                        api-key="no-api-key"
                        :init="{
         height: 500,
         menubar: false,
         plugins: [
           'advlist autolink lists link image charmap print preview anchor',
           'searchreplace visualblocks code fullscreen',
           'insertdatetime media table paste code help wordcount'
         ],
         toolbar:
           'undo redo | formatselect | bold italic backcolor | \
           alignleft aligncenter alignright alignjustify | \
           bullist numlist outdent indent | removeformat | help'
       }"
                        name="post_content" id="post_content" ref="post_content"
                        v-model="content"
                    />
                </div>
            </div>
        </div>
    </div>

    <br><br>

    <div class="border-b border-gray-900/10 pb-9">
        <nav class="flex items-center justify-center" aria-label="Progress">
            <ol role="list" class="ml-8 flex items-center space-x-5">
                <li v-for="cstep in totalsteps" :key="cstep.name">
                    <a v-if="cstep < data.step" @click="goto(cstep)" class="block h-2.5 w-2.5 rounded-full bg-indigo-600 hover:bg-indigo-900">
                    </a>
                    <span v-else-if="cstep == data.step" class="relative flex items-center justify-center" aria-current="cstep">
            <span class="absolute flex h-5 w-5 p-px" aria-hidden="true">
              <span class="h-full w-full rounded-full bg-indigo-200" />
            </span>
              <span class="relative block h-2.5 w-2.5 rounded-full bg-indigo-600" aria-hidden="true" />
          </span>
                    <span v-else  class="block h-2.5 w-2.5 rounded-full bg-gray-200 hover:bg-gray-400"></span>
                </li>
            </ol>
        </nav>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <button @click="goto(data.step-1)" v-if="data.step !=1" type="button" class="text-sm font-semibold leading-6 text-gray-900">Previous</button>
        <button @click="submit" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save as Post</button>
    </div>


</template>

<script>
import Editor from '@tinymce/tinymce-vue';

export default {

    props: {
        data: {
            type: Object,
            required: true,
        },
    },

    data() {
        return {
            totalsteps: 2,
            title: this.data.title,
            content: this.data.content,
            excerpt: this.data.excerpt,


        }
    },

    methods: {
        submit() {
            var actionData = {};
            if (this.data.step == 1) {
                actionData = {'action': 'submit', 'language': this.$refs.language.value};
            }
            this.$emit('submit', actionData);
        },
        goto(step) {
            this.$emit('submit', {'action': 'goto', 'step': this.data.step});
        },
        action(title) {
            this.$emit('action', {'action': title, 'step': this.data.step, 'route': '/wordpress-manager/callfromsubview'});
        },
    },

    components: {
        'editor': Editor
    }


};
</script>
