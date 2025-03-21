<template>
    <div class="flex flex-col flex-1 gap-4 rounded-xl">
      <div class="grid gap-4 auto-rows-min md:grid-cols-1">
        <div class="relative flex-col items-center justify-center overflow-hidden border aspect-video rounded-xl border-sidebar-border/70 dark:border-sidebar-border">
          <div class="p-6 overflow-y-auto rounded-lg shadow-md">
            <h2 class="h-40 mb-6 text-2xl font-bold text-center text-gray-400">Sponsored Posts</h2>
            <ul class="space-y-4">
              <li
                v-for="post in posts"
                :key="post.id"
                class="p-6 transition-shadow duration-200 border border-gray-700 rounded-lg hover:border-gray-400 hover:shadow-lg"
              >
                <a :href="post.link" class="block">
                  <h1 class="text-xl font-semibold text-gray-400 truncate">{{ post.title }}</h1>
                  <p class="max-w-full mt-2 text-base text-gray-200 truncate whitespace-nowrap">
                    {{ post.description }}
                  </p>
                  <div class="flex items-center justify-between mt-4 space-x-4">
                    <a :href="post.authorLink" class="block">
                      <p class="text-sm text-gray-400 hover:text-orange-300">{{ post.author }}</p>
                    </a>
                    <p class="text-xs text-gray-500">{{ post.time }}</p>
                    <a :href="post.categoryLink" class="block">
                      <p class="text-sm text-gray-400 cursor-pointer hover:text-orange-500">{{ post.category }}</p>
                    </a>
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </template>

  <script setup lang="ts">
  const posts = [
    {
      id: 1,
      title: 'How to Learn JavaScript in 30 Days',
      description: 'This post discusses a structured approach to mastering JavaScript over the course of 30 days, with daily tasks and tips.',
      author: 'John Doe',
      authorLink: '/forums/posts/users/1',
      time: '2 hours ago',
      category: 'Web Development',
      categoryLink: '/forums/categories/web-development',
      link: '/forums/posts/1',
    },
    {
      id: 2,
      title: 'Best Practices for Responsive Design',
      description: 'Learn the essential best practices for creating responsive websites that work well on all devices and screen sizes.',
      author: 'Jane Smith',
      authorLink: '/forums/posts/users/2',
      time: '4 hours ago',
      category: 'Design',
      categoryLink: '/forums/categories/design',
      link: '/forums/posts/2',
    },
    {
      id: 3,
      title: 'CSS Grid vs Flexbox: Which One to Use?',
      description: 'A detailed comparison of CSS Grid and Flexbox to help you decide which layout technique is best for your projects.',
      author: 'Michael Lee',
      authorLink: '/forums/posts/users/3',
      time: '1 day ago',
      category: 'CSS',
      categoryLink: '/forums/categories/css',
      link: '/forums/posts/3',
    },
    {
      id: 4,
      title: 'A Guide to SEO for Beginners',
      description: 'Discover the basics of Search Engine Optimization (SEO) and how you can start improving your website\'s visibility.',
      author: 'Sarah Taylor',
      authorLink: '/forums/posts/users/4',
      time: '3 days ago',
      category: 'SEO',
      categoryLink: '/forums/categories/seo',
      link: '/forums/posts/4',
    },
    {
      id: 5,
      title: 'Understanding Async Programming in JavaScript',
      description: 'Dive into the world of asynchronous programming in JavaScript and learn how to handle promises and async/await.',
      author: 'David Chen',
      authorLink: '/forums/posts/users/5',
      time: '1 week ago',
      category: 'JavaScript',
      categoryLink: '/forums/categories/javascript',
      link: '/forums/posts/5',
    },
  ];
  </script>
