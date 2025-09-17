<script setup>
import { useAuthStore } from '@/stores/auth';
import { storeToRefs } from 'pinia';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';


const formData = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
})

const { authenticate } = useAuthStore();
const router = useRouter();
const { errors } = storeToRefs(useAuthStore());

const register = async () => {
    const res = await authenticate('register', formData)

    if(res) {
        router.push({ name: 'home' }).then(() => {
            window.location.reload();
        })
    }
}
</script>

<template>
  <main>
    <!-- Register and login -->
    <section id="register-login-page" class="bg-white py-16">
      <div class="container mx-auto px-auto">
        <div class="flex flex-col md:flex-row justify-center">
          <div class="md:w-1/2 bg-white rounded-lg shadow-md p-4 md:p-10 md:m-10">
            <h2 class="text-2xl font-semibold mb-4">Register</h2>
            <form @submit.prevent="register">
              <div class="mb-3">
                <label for="register-name" class="block">Name</label>
                <input type="name" id="register-name" v-model="formData.name"
                  class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary"
                  required>
                <p v-if="errors?.name" class="text-xs text-red-500">{{ errors.name[0] }}</p>
              </div>
              <div class="mb-3">
                <label for="register-email" class="block">Email</label>
                <input type="email" id="register-email" v-model="formData.email"
                  class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary"
                  required>
                <p v-if="errors?.email" class="text-xs text-red-500">{{ errors.email[0] }}</p>

              </div>
              <div class="mb-3">
                <label for="register-password" class="block">Password</label>
                <input type="password" id="register-password" v-model="formData.password"
                  class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary"
                  required>
                <p v-if="errors?.password" class="text-xs text-red-500">{{ errors.password[0] }}</p>

              </div>
              <div class="mb-3">
                <label for="register-confirm-password" class="block ">Confirm Password</label>
                <input type="password" id="register-confirm-password" v-model="formData.password_confirmation"
                  class="w-full px-3 py-1 border focus:border-transparent rounded-full focus:outline-none focus:ring-2 focus:ring-primary"
                  required>
                <p v-if="errors?.password_confirmation" class="text-xs text-red-500">{{ errors.password_confirmation[0] }}</p>

              </div>
              <button type="submit"
                class="bg-primary text-white border border-primary hover:bg-transparent hover:text-primary py-2 px-3 rounded-full w-full">Register</button>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>