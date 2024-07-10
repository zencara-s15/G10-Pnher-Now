<template>
  <UserLayout></UserLayout>
  <div class="container delivery-list p-5">
    <!-- <div class="row d-flex justify-content-between">
      <div class="col-auto">
        <div class="input-group search-group" style="width: 500px">
          <span class="input-group-text bg-danger text-white">
            <i class="bi bi-search"></i>
          </span>
          <input
            type="text"
            class="form-control"
            placeholder="Search here..."
            v-model="searchQuery"
          />
          <button
            class="btn btn-outline-secondary"
            type="button"
            @click="clearSearch"
            :disabled="!searchQuery"
          >
            <i class="bi bi-x-square"></i>
          </button>
        </div>
      </div>
      <div class="col-auto d-flex gap-3" v-for="user in users_image" :key="user.image">
        <div class="col-auto">
          <button class="btn btn-light text-danger">
            <div class="message">
              <i class="bi bi-5-circle-fill"></i>
            </div>
            <i class="bi bi-chat-left"></i>
          </button>
        </div>
        <div class="col-auto">
          <button class="btn btn-light text-danger">
            <div class="notification">
              <i class="bi bi-3-circle-fill"></i>
            </div>
            <i class="bi bi-bell"></i>
          </button>
        </div>
        <div class="icon">
          <img :src="user.image" class="rounded-circle" width="40" height="40" />
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-12">
        <div class="mt-3 mb-3">
          <h2>Past Delivery</h2>
        </div>
        <div class="list-group">
          <div
            class="list-group-item d-flex justify-content-between align-items-center mb-3 border-red"
            v-for="(item, index) in filteredDeliveries"
            :key="index"
          >
            <div class="d-flex align-items-center">
              <div class="icon">
                <img :src="item.image" class="rounded-circle" width="40" height="40" />
              </div>
              <div class="ms-3">
                <div class="route fw-bold">{{ item.route }}</div>
                <div class="date text-muted">Delivered on {{ item.date }}</div>
              </div>
            </div>
            <div class="menu position-relative">
              <button class="btn btn-outline-secondary btn-sm" @click="toggleMenu(index)">⋮</button>
              <div v-if="openMenuIndex === index" class="dropdown-menu show position-absolute">
                <button class="dropdown-item" @click="editItem(index)">Edit</button>
                <button class="dropdown-item" @click="deleteItem(index)">Delete</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import WebLayout from '@/Components/Layouts/WebLayout.vue'
import UserLayout from '@/Components/Layouts/UserLayout.vue'

export default {
  components: {
    WebLayout,
    UserLayout
  },
  data() {
    return {
      searchQuery: '',
      openMenuIndex: null,
      deliveries: [
        {
          route: 'FROM BTB TO KPS',
          date: '20th June 2024',
          image: 'https://img.a.transfermarkt.technology/portrait/big/406635-1668524492.jpg?lm=1'
        },
        {
          route: 'FROM PHNOM PENH TO BTB',
          date: '15th May 2024',
          image: 'https://img.vavel.com/c700_475_3800763-77305188-2560-1440-1698005483328.jpg'
        },
        {
          route: 'FROM PHNOM PENH TO BTB',
          date: '10th May 2024',
          image: 'https://img.a.transfermarkt.technology/portrait/big/406635-1668524492.jpg?lm=1'
        },
        {
          route: 'FROM BTB TO PS',
          date: '10th May 2024',
          image: 'https://img.vavel.com/c700_475_3800763-77305188-2560-1440-1698005483328.jpg'
        },
        {
          route: 'FROM PHNOM PENH TO BTB',
          date: '15th April 2024',
          image: 'https://img.a.transfermarkt.technology/portrait/big/406635-1668524492.jpg?lm=1'
        }
      ],
      users_image: [
        {
          image:
            'https://assets.goal.com/images/v3/blt7c3d8e239aa1271e/Vini%20Jr%20-%20Stepping%20up%20without%20Neymar.jpg?auto=webp&format=pjpg&width=3840&quality=60'
        }
      ]
    }
  },
  computed: {
    filteredDeliveries() {
      return this.deliveries.filter((item) =>
        item.route.toLowerCase().includes(this.searchQuery.toLowerCase())
      )
    }
  },
  methods: {
    clearSearch() {
      this.searchQuery = ''
    },
    toggleMenu(index) {
      if (this.openMenuIndex === index) {
        this.openMenuIndex = null
      } else {
        this.openMenuIndex = index
      }
    },
    editItem(index) {
      // Handle edit logic here
      const item = this.deliveries[index]
      console.log('Edit item:', item)
      // Add your edit logic here, e.g., open a modal to edit the delivery details
    },
    deleteItem(index) {
      this.deliveries.splice(index, 1)
      this.openMenuIndex = null // Close the menu after deleting the item
      console.log('Deleted item at index:', index)
    }
  }
}
</script>

<style scoped>
.delivery-list {
  font-family: Arial, sans-serif;
}

.icon img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  margin-right: 10px;
}

.route {
  font-weight: bold;
}

.date {
  color: gray;
}

.menu .dropdown-menu {
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  min-width: 10rem;
  padding: 0.5rem 0;
  margin: 0.125rem 0 0;
  font-size: 1rem;
  color: #212529;
  text-align: left;
  list-style: none;
  background-color: #fff;
  background-clip: padding-box;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 0.25rem;
}

.menu .dropdown-menu.show {
  display: block;
}

.border-red {
  border: 1px solid rgb(164, 158, 158);
  border-radius: 5px;
}

.notification {
  position: fixed;
  top: 120px;
  right: 100px;
}

.message {
  position: fixed;
  top: 120px;
  right: 155px;
}
</style>
