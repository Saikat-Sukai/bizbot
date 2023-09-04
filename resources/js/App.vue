<template>
    <div>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="relative z-50 lg:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-900/80" />
                </TransitionChild>

                <div class="fixed inset-0 flex">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative mr-16 flex w-full max-w-xs flex-1">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute left-full top-0 flex w-16 justify-center pt-5">
                                    <button type="button" class="-m-2.5 p-2.5" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>

                            <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-gray-900 px-6 pb-2 ring-1 ring-white/10">
                                <div class="flex h-16 shrink-0 items-center">
                                    <img class="h-8 w-auto" src="https://bizbot.live/bizbot-dark.svg" alt="BizBot" />
                                </div>
                                <nav class="flex flex-1 flex-col">
                                    <ul role="list" class="-mx-2 flex-1 space-y-1">
                                        <li v-for="item in navigation" :key="item.name">
                                            <a :title="item.name" :href="item.href" :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold']">
                                                <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                                                {{ item.name }}
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </Dialog>
        </TransitionRoot>

        <!-- Static sidebar for desktop -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:left-0 lg:z-50 lg:block lg:w-20 lg:overflow-y-auto lg:bg-gray-900 lg:pb-4">
            <div class="flex h-16 shrink-0 items-center justify-center">
                <img class="h-8 w-auto" src="https://bizbot.live/favicon.png" alt="BizBot"/>
            </div>
            <nav class="mt-8">
                <ul role="list" class="flex flex-col items-center space-y-1">
                    <li v-for="item in navigation" :key="item.name">
                        <a :title="item.name" :href="item.href" :class="[item.current ? 'bg-gray-800 text-white' : 'text-gray-400 hover:text-white hover:bg-gray-800', 'group flex gap-x-3 rounded-md p-3 text-sm leading-6 font-semibold']">
                            <component :is="item.icon" class="h-6 w-6 shrink-0" aria-hidden="true" />
                            <span class="sr-only">{{ item.name }}</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="lg:pl-20">
            <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
                <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" @click="sidebarOpen = true">
                    <span class="sr-only">Open sidebar</span>
                    <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                </button>

                <!-- Separator -->
                <div class="h-6 w-px bg-gray-900/10 lg:hidden" aria-hidden="true" />

                <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
                    <div class="relative flex flex-1">
                        <label for="search-field" class="sr-only">Search</label>
                        <MagnifyingGlassIcon class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400" aria-hidden="true" />
                        <input :disabled="disabledState" :class="disabledState? 'bg-gray-200 cursor-not-allowed': ''" id="search-field" ref="searchField" class="h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Press / to chat"
                               type="search" name="search" @keyup.enter="processInstruction" v-model="newMessage"/>
<!--                               placeholder="Press / to chat, # for Settings" -->
                        <div v-if="disabledState" class="absolute inset-y-0 left-10 flex items-center pr-3">
                            <svg class="animate-spin h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

<!--                        <div class="hidden md:flex md:flex-wrap items-center bg-gray-50 px-4 py-2.5 text-xs text-gray-700">-->
<!--                            Type-->
<!--                            <kbd :class="['mx-1 flex h-5 w-5 items-center justify-center rounded border bg-white font-semibold sm:mx-2', newMessage.startsWith('#') ? 'border-indigo-600 text-indigo-600' : 'border-gray-400 text-gray-900']">#</kbd>-->
<!--                            <span class="sm:hidden">for projects,</span>-->
<!--                            <span class="hidden sm:inline">to access projects,</span>-->
<!--                            <kbd :class="['mx-1 flex h-5 w-5 items-center justify-center rounded border bg-white font-semibold sm:mx-2', newMessage.startsWith('>') ? 'border-indigo-600 text-indigo-600' : 'border-gray-400 text-gray-900']">&gt;</kbd>-->
<!--                            for users, and-->
<!--                            <kbd :class="['mx-1 flex h-5 w-5 items-center justify-center rounded border bg-white font-semibold sm:mx-2', newMessage === '?' ? 'border-indigo-600 text-indigo-600' : 'border-gray-400 text-gray-900']">?</kbd>-->
<!--                            for help.-->
<!--                        </div>-->

<!--                        <TransitionRoot :show="open" as="template" @after-leave="newMessage = ''" appear>-->
<!--                            <Dialog as="div" class="relative z-10" @close="open = false">-->
<!--                                <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">-->
<!--                                    <div class="fixed inset-0 bg-gray-500 bg-opacity-25 transition-opacity" />-->
<!--                                </TransitionChild>-->

<!--                                <div class="fixed inset-0 z-10 overflow-y-auto pt-40 sm:p-6 md:p-20">-->
<!--                                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 scale-95" enter-to="opacity-100 scale-100" leave="ease-in duration-200" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-95">-->
<!--                                        <DialogPanel class="mx-auto max-w-xl transform divide-y divide-gray-100 overflow-hidden rounded-xl bg-white shadow-2xl ring-1 ring-black ring-opacity-5 transition-all">-->
<!--                                            <Combobox @update:modelValue="onSelect">-->
<!--                                                <div class="relative">-->
<!--                                                    <MagnifyingGlassIcon class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-gray-400" aria-hidden="true" />-->
<!--                                                    <ComboboxInput class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." @change="newMessage = $event.target.value" />-->
<!--                                                </div>-->

<!--                                                <ComboboxOptions v-if="filteredProjects.length > 0 || filteredUsers.length > 0" static class="max-h-80 scroll-py-10 scroll-pb-2 space-y-4 overflow-y-auto p-4 pb-2">-->
<!--                                                    <li v-if="filteredProjects.length > 0">-->
<!--                                                        <h2 class="text-xs font-semibold text-gray-900">Projects</h2>-->
<!--                                                        <ul class="-mx-4 mt-2 text-sm text-gray-700">-->
<!--                                                            <ComboboxOption v-for="project in filteredProjects" :key="project.id" :value="project" as="template" v-slot="{ active }">-->
<!--                                                                <li :class="['flex cursor-default select-none items-center px-4 py-2', active && 'bg-indigo-600 text-white']">-->
<!--                                                                    <FolderIcon :class="['h-6 w-6 flex-none', active ? 'text-white' : 'text-gray-400']" aria-hidden="true" />-->
<!--                                                                    <span class="ml-3 flex-auto truncate">{{ project.name }}</span>-->
<!--                                                                </li>-->
<!--                                                            </ComboboxOption>-->
<!--                                                        </ul>-->
<!--                                                    </li>-->
<!--                                                    <li v-if="filteredUsers.length > 0">-->
<!--                                                        <h2 class="text-xs font-semibold text-gray-900">Users</h2>-->
<!--                                                        <ul class="-mx-4 mt-2 text-sm text-gray-700">-->
<!--                                                            <ComboboxOption v-for="user in filteredUsers" :key="user.id" :value="user" as="template" v-slot="{ active }">-->
<!--                                                                <li :class="['flex cursor-default select-none items-center px-4 py-2', active && 'bg-indigo-600 text-white']">-->
<!--                                                                    <img :src="user.imageUrl" alt="" class="h-6 w-6 flex-none rounded-full" />-->
<!--                                                                    <span class="ml-3 flex-auto truncate">{{ user.name }}</span>-->
<!--                                                                </li>-->
<!--                                                            </ComboboxOption>-->
<!--                                                        </ul>-->
<!--                                                    </li>-->
<!--                                                </ComboboxOptions>-->

<!--                                                <div v-if="newMessage === '?'" class="px-6 py-14 text-center text-sm sm:px-14">-->
<!--                                                    <LifebuoyIcon class="mx-auto h-6 w-6 text-gray-400" aria-hidden="true" />-->
<!--                                                    <p class="mt-4 font-semibold text-gray-900">Help with searching</p>-->
<!--                                                    <p class="mt-2 text-gray-500">Use this tool to quickly search for users and projects across our entire platform. You can also use the search modifiers found in the footer below to limit the results to just users or projects.</p>-->
<!--                                                </div>-->

<!--                                                <div v-if="query !== '' && newMessage !== '?' && filteredProjects.length === 0 && filteredUsers.length === 0" class="px-6 py-14 text-center text-sm sm:px-14">-->
<!--                                                    <ExclamationTriangleIcon class="mx-auto h-6 w-6 text-gray-400" aria-hidden="true" />-->
<!--                                                    <p class="mt-4 font-semibold text-gray-900">No results found</p>-->
<!--                                                    <p class="mt-2 text-gray-500">We couldn’t find anything with that term. Please try again.</p>-->
<!--                                                </div>-->

<!--                                                <div class="flex flex-wrap items-center bg-gray-50 px-4 py-2.5 text-xs text-gray-700">-->
<!--                                                    Type-->
<!--                                                    <kbd :class="['mx-1 flex h-5 w-5 items-center justify-center rounded border bg-white font-semibold sm:mx-2', newMessage.startsWith('#') ? 'border-indigo-600 text-indigo-600' : 'border-gray-400 text-gray-900']">#</kbd>-->
<!--                                                    <span class="sm:hidden">for projects,</span>-->
<!--                                                    <span class="hidden sm:inline">to access projects,</span>-->
<!--                                                    <kbd :class="['mx-1 flex h-5 w-5 items-center justify-center rounded border bg-white font-semibold sm:mx-2', newMessage.startsWith('>') ? 'border-indigo-600 text-indigo-600' : 'border-gray-400 text-gray-900']">&gt;</kbd>-->
<!--                                                    for users, and-->
<!--                                                    <kbd :class="['mx-1 flex h-5 w-5 items-center justify-center rounded border bg-white font-semibold sm:mx-2', newMessage === '?' ? 'border-indigo-600 text-indigo-600' : 'border-gray-400 text-gray-900']">?</kbd>-->
<!--                                                    for help.-->
<!--                                                </div>-->
<!--                                            </Combobox>-->
<!--                                        </DialogPanel>-->
<!--                                    </TransitionChild>-->
<!--                                </div>-->
<!--                            </Dialog>-->
<!--                        </TransitionRoot>-->


                    </div>

                    <div class="flex items-center gap-x-4 lg:gap-x-6">
<!--                        <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">-->
<!--                            <span class="sr-only">View notifications</span>-->
<!--                            <BellIcon class="h-6 w-6" aria-hidden="true" />-->
<!--                        </button>-->

<!--                        &lt;!&ndash; Separator &ndash;&gt;-->
<!--                        <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-900/10" aria-hidden="true" />-->

                        <!-- Profile dropdown -->
                        <Menu as="div" class="relative">
                            <MenuButton class="-m-1.5 flex items-center p-1.5">
                                <span class="sr-only">Open user menu</span>
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-500"><span class="font-medium leading-none text-white">{{nameinitials}}</span></span>
<!--                                <img class="h-8 w-8 rounded-full bg-gray-50" src="" alt="" />-->
                                <span class="hidden lg:flex lg:items-center">
                                    <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">{{user.name}}</span>
                                    <ChevronDownIcon class="ml-2 h-5 w-5 text-gray-400" aria-hidden="true" />
                                </span>
                            </MenuButton>
                            <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                <MenuItems class="absolute right-0 z-10 mt-2.5 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none">
                                    <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                        <a :href="item.href" :class="[active ? 'bg-gray-50' : '', 'block px-3 py-1 text-sm leading-6 text-gray-900']">{{ item.name }}</a>
                                    </MenuItem>
                                    <form method="POST" action="/logout" ref="logoutForm">
                                        <span @click="logout" class="hover:bg-gray-50 cursor-pointer block px-3 py-1 text-sm leading-6 text-gray-900">Logout</span>
                                    </form>
                                </MenuItems>
                            </transition>
                        </Menu>
                    </div>
                </div>
            </div>


            <main class="flex flex-col md:flex-row ">

                <!-- Chat Section -->
                <div class="md:w-2/5 overflow-y-auto md:border-r border-gray-200 px-3 py-5 h-full" :style="{ 'min-height': 'calc(70vh - 70px)' }">
                    <div ref="chatContainer" class="flex-1 overflow-y-scroll">
                        <div class="flex flex-col space-y-4">
                            <div v-for="message in messages" :key="message.id"
                                 class="rounded-lg px-5 py-3 max-w-xs"
                                 style="min-width: 240px"
                                 :class="message.author === 'user' ? 'text-right bg-green-100 self-end' : 'text-left bg-blue-100 self-start' "
                            >
                                <p v-html="message.text"></p>
                                <br/>
                                <div v-if="message.view && message.view=='alert'" class="mt-5 pointer-events-auto w-full max-w-sm overflow-hidden rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                                    <div class="p-4">
                                        <div class="flex items-start">
                                            <div class="flex-shrink-0">
                                                <InboxIcon class="h-6 w-6 text-gray-400" aria-hidden="true" />
                                            </div>
                                            <div class="ml-3 w-0 flex-1 pt-0.5">
                                                <p class="text-sm font-medium text-gray-900">{{message.data.title}}</p>
                                                <p class="mt-1 text-sm text-gray-500">{{message.data.message}}</p>
<!--                                                <div class="mt-3 flex space-x-7">-->
<!--                                                    <button type="button" class="rounded-md bg-white text-sm font-medium text-indigo-600 hover:text-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Undo</button>-->
<!--                                                    <button type="button" class="rounded-md bg-white text-sm font-medium text-gray-700 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Dismiss</button>-->
<!--                                                </div>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-if="message.view && message.view=='choice'" class="mt-5 col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
                                    <div class="flex w-full items-center justify-between space-x-6 p-6">
                                        <div class="flex-1 truncate">
                                            <div class="flex items-center space-x-3">
                                                <h3 class="truncate text-sm font-medium text-gray-900">Jane Cooper</h3>
                                                <span class="inline-flex flex-shrink-0 items-center rounded-full bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Admin</span>
                                            </div>
                                            <p class="mt-1 truncate text-sm text-gray-500">Regional Paradigm Technician</p>
                                        </div>
                                        <img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                    </div>
                                    <div>
                                        <div class="-mt-px flex divide-x divide-gray-200">
                                            <div class="flex w-0 flex-1">
                                                <a href="mailto:janecooper@example.com" class="relative -mr-px inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-bl-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path d="M3 4a2 2 0 00-2 2v1.161l8.441 4.221a1.25 1.25 0 001.118 0L19 7.162V6a2 2 0 00-2-2H3z"></path>
                                                        <path d="M19 8.839l-7.77 3.885a2.75 2.75 0 01-2.46 0L1 8.839V14a2 2 0 002 2h14a2 2 0 002-2V8.839z"></path>
                                                    </svg>
                                                    Email
                                                </a>
                                            </div>
                                            <div class="-ml-px flex w-0 flex-1">
                                                <a href="tel:+1-202-555-0170" class="relative inline-flex w-0 flex-1 items-center justify-center gap-x-3 rounded-br-lg border border-transparent py-4 text-sm font-semibold text-gray-900">
                                                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                        <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Call
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <template v-if="message.view && message.view=='links'" class="my-5">
                                    <h2 class="text-sm font-medium text-gray-500">Suggested Links:</h2>
                                    <ul role="list" class="mt-3 grid grid-cols-1 gap-5 " v-if="message.data.links">
                                        <li v-for="link in message.data.links" :key="link.name" class="col-span-1 flex rounded-md shadow-sm">
                                            <div :class="[link.bgColor, 'flex w-10 flex-shrink-0 items-center justify-center rounded-l-md text-sm font-medium text-white']">
                                                <PlayIcon class="h-6 w-6" aria-hidden="true" v-if="link.icon == 'PlayIcon'"/>
                                            </div>
                                            <div class="flex flex-1 items-center justify-between rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                                                <div class="flex-1 px-4 py-2 text-sm">
                                                    <a :href="link.href" target="_blank" class="font-medium text-gray-900 hover:text-gray-600">{{ link.name }}</a>
<!--                                                    <p class="text-gray-500">{{ link.members }} Members</p>-->
                                                </div>
<!--                                                <div class="flex-shrink-0 pr-2">-->
<!--                                                    <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">-->
<!--&lt;!&ndash;                                                        <span class="sr-only">Open options</span>&ndash;&gt;-->
<!--                                                        <LinkIcon class="h-5 w-5" aria-hidden="true" />-->

<!--&lt;!&ndash;                                                        <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />&ndash;&gt;-->
<!--                                                    </button>-->
<!--                                                </div>-->
                                            </div>
                                        </li>
                                    </ul>
                                </template>
                            </div>
                        </div>
                        <div ref="chatBottomEl" class="mt-2">&nbsp;</div>
                    </div>
                </div>

                <!-- Results Section -->
                <div class="border-t w-full px-4 py-10 sm:px-6 lg:px-8 lg:py-6" :style="{ 'min-height': 'calc(100vh - 70px)' }">
                    <div ref="result" id="result">


<!--                        <div class="col-span-12">-->
<!--                            <label for="post_excerpt" class="block text-sm font-medium leading-6 text-gray-900">Sales Report - Q3 2022 :</label>-->
<!--                            <div class="mt-2">-->
<!--                                <div class="block w-full rounded-md border-0 p-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">-->
<!--<b>Date: September 15, 2022</b>-->
<!--                                    <br>-->
<!--Dear Argentum Team,-->
<!--                                    <br>-->
<!--We are pleased to present the sales report for the third quarter of 2022. This report provides valuable insights into our performance and projections during this crucial period. As always, we remain committed to transparency and growth.-->

<!--                                    <br>-->
<!--                                    <br>-->
<!--<h2 class="text-base font-semibold leading-7 text-gray-900">Executive Summary:</h2>-->
<!--<p>The third quarter of 2022 has shown promising trends, with a focus on expanding market reach and launching new product offerings. Our teams have worked diligently to achieve strong sales figures, and we anticipate continued growth in the coming months.</p>-->

<!--<h2>Projected Sales Figures:</h2>-->
<!--<ul>-->
<!--    <li class="bg-purple-300">Total Revenue: $1,500,000</li>-->
<!--    <li>-->
<!--        - Breakdown by Product Categories:-->
<!--        <ul>-->
<!--            <li>Product A: $750,000</li>-->
<!--            <li>Product B: $450,000</li>-->
<!--            <li>Product C: $300,000</li>-->
<!--        </ul>-->
<!--    </li>-->
<!--</ul>-->
<!--                                    <br><br>-->
<!--                                    <h3>Key Initiatives and Achievements:</h3>-->
<!--                                    <ul>-->
<!--                                        <li>Successful launch of Product C in [Target Market], contributing significantly to revenue.</li>-->
<!--<li>Strengthened partnerships with key distributors, resulting in increased sales outreach.</li>-->
<!--<li>Marketing campaigns resulted in a notable uptick in customer engagement and brand visibility.</li>-->
<!--                                    </ul>-->

<!--                                    <h3>Market Analysis:</h3>-->
<!--<p>Our projections are based on a comprehensive market analysis that considers current trends, customer preferences, and competitive landscape. As we continue to refine our strategies, we remain adaptable to market dynamics.</p>-->

<!--<h6>Notes:</h6>-->
<!--<ul>-->
<!--    <li>Projections are based on historical sales trends and market analysis.</li>-->
<!--    <li>Please note that these figures are subject to adjustments as the quarter progresses.</li>-->
<!--</ul>-->

<!--<p>We encourage all team members to review this report carefully and reach out to the respective department heads for any clarifications or insights. Our collective efforts are driving us toward our goals, and we look forward to a successful Q4.</p>-->
<!--                                    <p>Thank you for your dedication and hard work.</p>-->

<!--<p>Attachments:</p>-->
<!--<p>Detailed Sales Data (Excel Spreadsheet)</p>-->
<!--<p>Customer Engagement Analytics (PDF)</p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->


                        <component @action="actionFromAction" @click="clickFromAction" @submit="submitFromAction" :is="resultView" :data="dataToAction"></component>
<!--                        <setupForm  :data="dataToAction"></setupForm>-->
<!--                        <suggestions  :data="dataToAction"></suggestions>-->

                        <div v-if="processing" class="flex items-center pr-3">
                            <svg class="animate-spin h-10 w-10 text-blue-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>

                    </div>
<!--                    <br>-->
<!--                    <div class="w-full lg:col-start-3 lg:row-end-1">-->
<!--                        <h2 class="sr-only">Summary</h2>-->
<!--                        <div class="rounded-lg bg-gray-50 shadow-sm ring-1 ring-gray-900/5">-->
<!--                            <dl class="flex flex-wrap">-->
<!--                                <div class="flex-auto pl-6 pt-6">-->
<!--                                    <dt class="text-sm font-semibold leading-6 text-gray-900">Amount</dt>-->
<!--                                    <dd class="mt-1 text-base font-semibold leading-6 text-gray-900">$10,560.00</dd>-->
<!--                                </div>-->
<!--                                <div class="flex-none self-end px-6 pt-4">-->
<!--                                    <dt class="sr-only">Status</dt>-->
<!--                                    <dd class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Paid</dd>-->
<!--                                </div>-->
<!--                                <div class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6">-->
<!--                                    <dt class="flex-none">-->
<!--                                        <span class="sr-only">Client</span>-->
<!--                                        <UserCircleIcon class="h-6 w-5 text-gray-400" aria-hidden="true" />-->
<!--                                    </dt>-->
<!--                                    <dd class="text-sm font-medium leading-6 text-gray-900">Alex Curren</dd>-->
<!--                                </div>-->
<!--                                <div class="mt-4 flex w-full flex-none gap-x-4 px-6">-->
<!--                                    <dt class="flex-none">-->
<!--                                        <span class="sr-only">Due date</span>-->
<!--                                        <CalendarDaysIcon class="h-6 w-5 text-gray-400" aria-hidden="true" />-->
<!--                                    </dt>-->
<!--                                    <dd class="text-sm leading-6 text-gray-500">-->
<!--                                        <time datetime="2023-01-31">January 31, 2023</time>-->
<!--                                    </dd>-->
<!--                                </div>-->
<!--                                <div class="mt-4 flex w-full flex-none gap-x-4 px-6">-->
<!--                                    <dt class="flex-none">-->
<!--                                        <span class="sr-only">Status</span>-->
<!--                                        <CreditCardIcon class="h-6 w-5 text-gray-400" aria-hidden="true" />-->
<!--                                    </dt>-->
<!--                                    <dd class="text-sm leading-6 text-gray-500">Paid with MasterCard</dd>-->
<!--                                </div>-->
<!--                            </dl>-->
<!--                            <div class="mt-6 border-t border-gray-900/5 px-6 py-6">-->
<!--                                <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Download receipt <span aria-hidden="true">&rarr;</span></a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <br>-->

                </div>


            </main>
        </div>

    </div>

    <notification-popup v-for="notification in notifications" :title="notification.title"></notification-popup>

</template>

<script setup>
import { computed, ref } from 'vue'
import { ChevronDownIcon, MagnifyingGlassIcon, PhotoIcon, CalendarDaysIcon, CreditCardIcon, UserCircleIcon } from '@heroicons/vue/20/solid'
import { Combobox, ComboboxInput, ComboboxOptions, ComboboxOption, Dialog, DialogPanel, Menu, MenuButton, MenuItem, MenuItems, TransitionChild, TransitionRoot } from '@headlessui/vue'
import { AdjustmentsVerticalIcon, Bars3Icon, BellIcon, LinkIcon, PlayIcon, CalendarIcon, ChartPieIcon, DocumentDuplicateIcon, FolderIcon, HomeIcon, UsersIcon, UserGroupIcon, XMarkIcon, CogIcon, PlusIcon, ChatBubbleBottomCenterIcon, CheckCircleIcon} from '@heroicons/vue/24/outline'
import NotificationPopup from "./components/notificationPopup.vue";

const navigation = [
    { name: 'Dashboard', href: '#', icon: HomeIcon, current: true },
    // { name: 'Documents', href: '#', icon: DocumentDuplicateIcon, current: false },
    // { name: 'Team', href: '#', icon: UsersIcon, current: false },
    { name: 'Support', href: '#', icon: UserGroupIcon, current: false },
    // { name: 'Tasks', href: '#', icon: FolderIcon, current: false },
    // { name: 'Calendar', href: '#', icon: CalendarIcon, current: false },
    // { name: 'Reports', href: '#', icon: ChartPieIcon, current: false },
    // { name: 'History', href: '#', icon: ChatBubbleBottomCenterIcon, current: false },
    // { name: 'Addons', href: '#', icon: PlusIcon, current: false },
    // { name: 'Settings', href: '#', icon: AdjustmentsVerticalIcon, current: false },
];

const userNavigation = [
    { name: 'Your profile', href: '/profile' },
    // { name: 'Sign out', href: '#' },
]

const sidebarOpen = ref(false)
const show = ref(true);

import { EllipsisVerticalIcon } from '@heroicons/vue/20/solid'



import setupForm from './components/setupForm.vue';
import suggestions from './components/suggestions.vue';
import notificationPopup from './components/notificationPopup.vue';

</script>
<script>
export default {
    mounted() {
        if(! window.last5conversations.length){ this.setup();}else{
            window.last5conversations.forEach((message) => {
                if(message.user_input){
                    this.messages.push({ id: message.created_at, 'author': 'user', text: message.user_input });
                }
                if(message.final_output){
                    this.messages.push({ id: message.created_at, 'author': 'system', text: message.final_output });
                }

            });
        }
        window.addEventListener("keypress", this.onKeyPress);
    },

    beforeDestroy() {
        window.removeEventListener("keypress", this.onKeyPress);
    },

    computed: {
        disabledState(){
          return this.appState.disabled ?? false;
        },
        filteredPeople() {
            return this.people.filter((person) => {
                return person.name.toLowerCase().includes(this.query.toLowerCase())
            })
        },
        query(){
            return this.newMessage.value.toLowerCase().replace(/^[#>]/, '');
        },
        filteredProjects() {
            return (
                this.newMessage.value === '#'
                    ? this.projects
                    : this.query.value === '' || this.newMessage.startsWith('>')
                        ? []
                        : this.projects.filter((project) => project.name.toLowerCase().includes(this.query.value))
            )
        },
        filteredUsers() {
            return (
                this.newMessage.value === '>'
                    ? this.users
                    : this.query.value === '' || this.newMessage.startsWith('#')
                        ? []
                        : this.users.filter((user) => user.name.toLowerCase().includes(this.query.value))
            );
        },
        nameinitials(){
            var parts = this.user.name.split(' ');
            var initials = ''
            for (var i = 0; i < parts.length; i++) {
                if (parts[i].length > 0 && parts[i] !== '') {
                    initials += parts[i][0]
                }
            }
            return initials;
        }
    },

    data() {
        return {
            processing: false,
            dynamicComponentName: '',
            user: window.user,
            notifications:[],
            resultView: '',
            resultData: '',
            resultText: '',
            appState: [],
            dataToAction: [],
            open: false,
            query:'',
            newMessage: '',
            messages: [],
            people: [
                { id: 1, name: 'Leslie Alexander', url: '#' },
                { id: 2, name: 'Xirac', url: '#' },
                // More people...
            ],
            projects: [
                { id: 1, name: 'Workflow Inc. / Website Redesign', category: 'Projects', url: '#' },
                // More projects...
            ],
            users: [
                {
                    id: 1,
                    name: 'Leslie Alexander',
                    url: '#',
                    imageUrl:
                        'https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80',
                },
                // More users...
            ],


        }
    },
    methods: {



        onSelect(person){
            console.log(person);
            this.open=false;
        },

        logout() {
            this.$refs.logoutForm.submit()
        },

        onKeyPress(e) {
            if (e.key === "/") {
                e.preventDefault();
                this.$refs.searchField.focus();
            }
            if (e.key === "#") {
                e.preventDefault();
                this.open = true;
            }
        },

        scrollToBottom() {
            this.$refs.chatBottomEl?.scrollIntoView({ behavior: 'smooth' });
        },


        processInstruction() {
            if (this.newMessage.trim() !== '') {
                this.processing = true;
                this.messages.push({ id: Date.now(), 'author': 'user', text: this.newMessage.trim() });
                axios.post('/api/instruction', {
                    message: this.newMessage.trim()
                }).then((response) => {
                    console.log(response.data);

                    var newMsg = {}; newMsg.id = Date.now(); newMsg.author = 'system';
                    if(response.data.resultView){ newMsg.view = response.data.resultView; }
                    if(response.data.resultData){ newMsg.data = response.data.resultData; }
                    if(response.data.resultText){ newMsg.text = response.data.resultText; }
                    this.messages.push(newMsg);

                    if(response.data.appState){ this.appState = response.data.appState; }
                    if(response.data.resultView){ this.resultView = response.data.resultView; }
                    if(response.data.resultData){ this.resultData = response.data.resultData; }
                    if(response.data.resultText){ this.resultText = response.data.resultText; }
                    if(response.data.dataToAction){ this.dataToAction = response.data.dataToAction; }

                    this.processing = false;

                    this.newMessage = '';
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });

                });


                // Here you could call a method to handle the user's message and add a bizbot reply.
            }
        },

        setup(){

            axios.post('/api/initialmessage').then((response) => {
                console.log(response.data);
                var newMsg = {}; newMsg.id = Date.now(); newMsg.author = 'system';

                if(response.data.messageView){ newMsg.view = response.data.messageView; }
                if(response.data.messageData){ newMsg.data = response.data.messageData; }
                if(response.data.messageText){
                    newMsg.text = response.data.messageText;
                    this.messages.push(newMsg);
                }

                if(response.data.resultText){ this.resultText = response.data.resultText; }
                if(response.data.resultView){ this.resultView = response.data.resultView; }
                if(response.data.resultData){ this.resultData = response.data.resultData; }

                if(response.data.dataToAction){ this.dataToAction = response.data.dataToAction; }

                if(response.data.appState){ this.appState = response.data.appState; }

                if(response.data.notification){ this.notifications.push({'title': response.data.notification.title, 'type': response.data.notification.type});}

            });

        },

        submitFromAction(dataFromAction) {
            console.log(dataFromAction);
             axios.post('/api/callfromsubview', {
                 resultView: this.resultView,
                 resultData: this.resultData,
                 appState: this.appState,
                 dataToAction: this.dataToAction,
                 dataFromAction: dataFromAction
                }).then((response) => {

                 var newMsg = {}; newMsg.id = Date.now(); newMsg.author = 'system';

                 if(response.data.messageView){ newMsg.view = response.data.messageView; }
                 if(response.data.messageData){ newMsg.data = response.data.messageData; }
                 if(response.data.messageText){
                     newMsg.text = response.data.messageText;
                     this.messages.push(newMsg);
                 }

                 if(response.data.resultText){ this.resultText = response.data.resultText; }
                 if(response.data.resultView){ this.resultView = response.data.resultView; }
                 if(response.data.resultData){ this.resultData = response.data.resultData; }

                 if(response.data.dataToAction){ this.dataToAction = response.data.dataToAction; }

                 if(response.data.appState){ this.appState = response.data.appState; }

                if(response.data.notification){ this.notifications.push({'title': response.data.notification.title, 'type': response.data.notification.type});}


                 // console.log(response.data);
                 //    if(response.data.messageText){ this.messageText = response.data.messageText;}
                 //    if(response.data.resultView){ this.resultView = response.data.resultView;}
                 //    if(response.data.resultData){ this.resultData = response.data.resultData;}
                 //    if(response.data.appState){ this.appState = response.data.appState;}
                 //    if(response.data.dataToAction){ this.dataToAction = response.data.dataToAction;}

                });

            },

        clickFromAction(suggestionItem){
            // alert(suggestionItem.suggestion);
            // console.log(suggestionItem.suggestion);
            this.newMessage = suggestionItem.suggestion;
            // this.processInstruction();
        },
        actionFromAction(data){
            console.log(data);
            axios.post(data.route, {
                resultView: this.resultView,
                resultData: this.resultData,
                appState: this.appState,
                dataToAction: this.dataToAction,
                // dataFromAction: dataFromAction
            }).then((response) => {
                console.log(response.data);
                var newMsg = {}; newMsg.id = Date.now(); newMsg.author = 'system';
                if(response.data.messageView){ newMsg.view = response.data.messageView; }
                if(response.data.messageData){ newMsg.data = response.data.messageData; }
                if(response.data.messageText){
                    newMsg.text = response.data.messageText;
                    this.messages.push(newMsg);
                }
                if(response.data.resultText){ this.resultText = response.data.resultText; }
                if(response.data.resultView){ this.resultView = response.data.resultView; }
                if(response.data.resultData){ this.resultData = response.data.resultData; }
                if(response.data.dataToAction){ this.dataToAction = response.data.dataToAction; }
                if(response.data.appState){ this.appState = response.data.appState; }
                if(response.data.notification){ this.notifications.push({'title': response.data.notification.title, 'type': response.data.notification.type});}

            });


        }
        },



}
</script>
