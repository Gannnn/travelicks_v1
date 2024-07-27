<template>
  <DashboardLayout title="Dashboard">
    <div class="dashboard-content">
      <div class="pt-5 mt-20">
        <div class="dashboard-container">

          <div class="dashboard-card" >
            <div class="wrap">
              <h4 class="heading hind-font medium-font-weight dashboard-title">Your Total Listings</h4>
              <span class="hind-font caption-12 dashboard-counter">{{ props.total_listings }}</span>
            </div>
          </div>

          <div class="dashboard-card" >
            <div class="wrap">
              <h4 class="heading hind-font medium-font-weight dashboard-title">Total Reservations</h4>
              <span class="hind-font caption-12 dashboard-counter">{{ props.total_reservations }}</span>
            </div>
          </div>

          <div v-if="props.is_admin" class="dashboard-card">
            <div class="wrap">
              <h4 class="heading hind-font medium-font-weight dashboard-title">All Listings</h4>
              <span class="hind-font caption-12 dashboard-counter">
                <router-link :href="route('admin.dashboard.listings')">{{ props.all_listings }}</router-link>
              </span>
            </div>
          </div>

        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue';

const props = defineProps({
  total_listings: {
    required: true,
  },
  all_listings: {
    required: true,
  },
  total_reservations: {
    required: true,
  },
  is_admin: {
    type: Boolean,
    required: true,
  },
});

console.log(props.total_listings);
</script>

<style scoped>
.dashboard-content {
  padding: 20px;
  overflow-x: hidden; /* Ensure no horizontal overflow */
}

.dashboard-container {
  display: flex;
  flex-wrap: wrap; /* Allow cards to wrap to the next line */
  gap: 2vw;
}

.dashboard-card {
  flex: 1 1 calc(33.333% - 2vw); /* Ensure cards take up a third of the row, minus the gap */
  min-width: 200px; /* Prevent cards from becoming too small */
  margin-bottom: 15px;
}

.dashboard-card .wrap {
  background: #ffffff;
  box-shadow: 2px 10px 20px rgba(0, 0, 0, 0.1);
  border-radius: 7px;
  text-align: center;
  position: relative;
  overflow: hidden;
  padding: 40px 25px 20px;
  height: 100%;
}

.dashboard-title,
.dashboard-info {
  color: #6c6c6c;
  font-size: 1.18em;
}

.dashboard-card span {
  display: block;
}

.dashboard-counter {
  font-weight: 600;
  font-size: 2.5em;
  line-height: 64px;
  color: #323c43;
}

.dashboard-card .wrap:after {
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 10px;
  content: "";
}

.dashboard-card:nth-child(1) .wrap:after {
  background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
}

.dashboard-card:nth-child(2) .wrap:after {
  background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
}

.dashboard-card:nth-child(3) .wrap:after {
  background: linear-gradient(69.83deg, #3599dc  0%, #2877ad  100%);
}

.dashboard-card:nth-child(4) .wrap:after {
  background: linear-gradient(81.67deg, #ffc107 0%, #e6ae06 100%);
}

.dashboard-card:nth-child(5) .wrap:after {
  background: linear-gradient(82.59deg, #00c48c 0%, #00a173 100%);
}

.dashboard-card:nth-child(6) .wrap:after {
  background: linear-gradient(81.67deg, #0084f4 0%, #1a4da2 100%);
}

.dashboard-card:nth-child(7) .wrap:after {
  background: linear-gradient(69.83deg, #3599dc  0%, #2877ad  100%);
}

.dashboard-card:nth-child(8) .wrap:after {
  background: linear-gradient(81.67deg, #ffc107 0%, #e6ae06 100%);
}

.dashboard-title svg {
  color: #d7d7d7;
  margin-left: 5px;
}

@media screen and (max-width: 768px) {
  .dashboard-container {
    flex-direction: column;
  }
}
</style>
