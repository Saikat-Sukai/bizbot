<template>
    <div>
        <div class="py-5">
            <div v-show="data.step==1">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="language" class="block text-sm font-medium leading-6 text-gray-900">Please select your Language (and Click on "Next"): </label>
                        <div class="mt-2">
                            <select ref="language" id="language" name="language" autocomplete="language" class="block w-full rounded-md border-0 py-2 px-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
                                <option value="en">English</option>
                                <option value="es" disabled>Spanish (coming soon)</option>
                                <option value="zh" disabled>Chinese (coming soon)</option>
                                <option value="ar" disabled>Arabic (coming soon)</option>
                                <option value="de" disabled>German (coming soon)</option>
                                <option value="fr" disabled>French (coming soon)</option>
                                <option value="pt" disabled>Portuguese (coming soon)</option>
                                <option value="ja" disabled>Japanese (coming soon)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="data.step==2">
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">Please enter name of the business for which I will be assisting you (and Click on "Next") :</label>
                        <div class="mt-2">
                            <input type="text" name="business" id="business" ref="business" autocomplete="business-name" class="block w-full rounded-md border-0 px-3 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="data.step==3">
                <div class="gap-x-6 sm:grid-cols-6">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Setup Account at My Parent Website <a href="https://BizBot.site" class="text-blue-600">https://BizBot.site</a></h2><br>
                <p class="mt-1 text-sm leading-6 text-gray-600">I need to access to my parent website and its marketplace to understand our conversation and for updating my capabilities.
                    <br>
                    By doing this, you agree to the <a href="https://bizbot.site/licence" target="_blank" class="text-blue-600">BizBot Licence</a>. Your core business data is not sent over, as per our <a href="https://bizbot.site/privacy" target="_blank" class="text-blue-600">Privacy Policy</a>
                    <br><br><br>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">#1. Please click <a href="https://bizbot.site/register" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600" target="_blank">here</a> and register (opens in new tab)</h2>
                    <br><br>
                    <h2 class="text-base font-semibold leading-7 text-gray-900">#2. After registration, click the "Create Token" button at the dashboard. This opens up a new tab and shows your token. Please copy the token and paste it below:</h2>
                    <br>
                </p>
                <div class="col-span-full">
<!--                    <label for="token" class="block text-sm font-medium leading-6 text-gray-900">Paste token here:</label>-->
                    <div class="mt-2">
                        <input type="text" name="token" id="token" ref="token" autocomplete="token" placeholder="Paste token here" class="block w-full rounded-md border-0 px-3 py-1 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                    </div>
                </div>
                    <br><br>
                    <iframe width="300" height="150" src="https://www.youtube.com/embed/kopoLzvh5jY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>

            </div>
            <div v-show="data.step==4">
                <h2 class="text-base font-semibold leading-7 text-gray-900">OpenAI API Key</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">Please create an account at https://openai.com . I rely on OpenAI's GPT3.5 for my intelligence. <br><br>Your API Keys can be found at <a href="https://platform.openai.com/account/api-keys" target="_blank" class="text-blue-600">https://platform.openai.com/account/api-keys</a></p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Enter your OpenAI Key below:</label>
                        <div class="mt-2">
                            <input type="text" name="openaikey" id="openaikey" ref="openaikey" autocomplete="openaikey" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" />
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="data.step==5">
                <h2 class="text-base font-semibold leading-7 text-gray-900">Business Model</h2>
<!--                <p class="mt-1 text-sm leading-6 text-gray-600"></p>-->

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="col-span-full">
                        <label for="businessmodel" class="block text-sm font-medium leading-6 text-gray-900">Can you please help me understand the business? What is it that we do in our business? We will be talking a lot more about this in the future, but for now can you please provide me with a summary?</label>
                        <div class="mt-2">
                            <textarea rows="4" name="businessmodel" id="businessmodel" ref="businessmodel" class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            placeholder="XYZNuts is a supplier of speciality Nuts and Bolts made of steel. We are a manufacturer based out of India, and have warehouses in Paris and London. I am the owner of the business, and we have 3 employees Aaron, Babe and Chad to help us. Aaron works in sales, Babe is in customer service and Chad is the manufacturing head. We sell our products through our website intellistore.com. "
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div v-show="data.step==6">
                <h2 class="text-base font-semibold leading-7 text-gray-900 mb-6">Recommended Modules:</h2>
                <ul role="list" class="grid gap-6 grid-cols-3">
                    <li v-for="module in data.modules" :key="module.slug" class="col-span-1 flex flex-col divide-y divide-gray-200 rounded-lg bg-white text-center shadow">
                        <div class="flex flex-1 flex-col p-3">
                            <img class="mx-auto h-10 w-10 flex-shrink-0 rounded-full" :src="module.imageUrl" alt="" />
                            <h3 class="mt-5 text-sm font-medium text-gray-900">{{ module.title }}</h3>
                            <dl class="mt-1 flex flex-grow flex-col justify-between">
<!--                                <dt class="sr-only">Title</dt>-->
                                <dd class="text-sm text-gray-500">{{ module.description }}</dd>
<!--                                <dt class="sr-only">Description</dt>-->
                                <dd class="mt-3">
                                    <span class="inline-flex items-center rounded-full bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20" v-if="module.type == 'Free'">{{ module.type }}</span>
                                    <span class="inline-flex items-center rounded-full bg-red-50 px-2 py-1 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/20" v-if="module.type == 'Paid'">{{ module.type }}</span>
                                </dd>
                            </dl>
                        </div>
                        <div>
                            <div class="-mt-px flex divide-x divide-gray-200">
                                <div class="flex w-0 flex-1">
                                    <div class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                        <div class="relative flex items-center">
                                            <div class="flex h-6 items-center">
                                                <input :id="module.slug" name="module" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />
                                            </div>
                                            <div class="ml-3 text-sm leading-6">
                                                <label for="comments" class="font-medium text-gray-900">Install</label>
<!--                                                <p id="comments-description" class="text-gray-500">Get notified when someones posts a comment on a posting.</p>-->
                                            </div>
                                        </div>
<!--                                        <input id="comments" aria-describedby="comments-description" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600" />-->
<!--                                        Install-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

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
            <button @click="submit" type="button" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Next</button>
        </div>
    </div>

</template>




<script>
export default {
    data() {
        return {
            totalsteps: 6,
            domain: window.domain,
            callbacklink: window.callbacklink,

        }
    },
    mounted() {
        if(window.preferencesContext && window.preferencesContext.language){
            this.$refs.language.value = window.preferencesContext.language;
        }
        if(window.businessContext && window.businessContext.name){
            console.log(window.businessContext);
            console.log(window.businessContext.name);
            this.$refs.business.value = window.businessContext.name;
        }
        if(window.openaikey){
            this.$refs.openaikey.value = window.openaikey;
        }
        if(window.token){
            this.$refs.token.value = window.token;
        }
        if(window.businessModelContext){
            this.$refs.businessmodel.value = window.businessModelContext;
        }
    },
    props: {
        data: {
            type: Array,
            required: true,
        },
    },

    methods: {
        submit() {
            var actionData = {};
            if(this.data.step==1){
                actionData = {'action':'submit', 'language': this.$refs.language.value};
            }
            if(this.data.step==2){
                if(this.$refs.business.value==0){
                    alert('Please provide the business name');
                    return;
                }
                actionData = {'action':'submit', 'business': this.$refs.business.value};
            }
            if(this.data.step==3){
                if(this.$refs.token.value==0){
                    alert('Please provide the token. I cannot function without it :( ');
                    return;
                }
                actionData = {'action':'submit', 'token': this.$refs.token.value, data:{'domain': window.domain} };
            }
            if(this.data.step==4){
                if(this.$refs.openaikey.value==0){
                    alert('Please provide the key. I cannot function without it :( ');
                    return;
                }
                actionData = {'action':'submit', 'openaikey': this.$refs.openaikey.value};
            }
            if(this.data.step==5){
                if(this.$refs.businessmodel.value==0){
                    alert('Please help me understand your business, so I may serve you to the best of my ability ! ');
                    return;
                }
                actionData = {'action':'submit', 'businessmodel': this.$refs.businessmodel.value};
            }
            if(this.data.step==6){

                var allboxes = '';
                var markedCheckbox = document.querySelectorAll('input[type="checkbox"]:checked');
                for (var checkbox of markedCheckbox) {
                    allboxes+= (checkbox.id+',');
                }
                actionData = {'action':'submit', 'checkedModules': allboxes, 'allModules': this.data.modules };
            }



            this.$emit('submit', actionData);
        },
        goto(step) {
            this.$emit('submit',{'action':'goto', 'step': step});
        },
    }
}
</script>
