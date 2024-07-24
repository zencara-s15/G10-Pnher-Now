import { defineStore } from 'pinia';
import axiosInstance from '@/plugins/axios';
import { ref } from 'vue';

interface Baggage {
  id: number;
  type: string;
  weight: number;
  receiver_phone: string;
  sending_address: string;
  company: string;
  receiving_address: string;
  post_id: number;
  delivery_status_id: number;
  longitude?: number; // Optional properties
  latitude?: number; // Optional properties
}

export const usePostBaggageStore = defineStore('postBaggage', {
  state: () => ({
    post_baggage: [] as Baggage[],
    user_baggage: [] as number[],
    responseMessage: ref<string | null>(null)
  }),
  actions: {
    async fetchPostBaggage() {
      try {
        const response = await axiosInstance.get('/baggage_list');
        this.post_baggage = response.data.data;
        this.user_baggage = this.post_baggage.map(baggage => baggage.post_id);
        console.log(this.user_baggage);
      } catch (error) {
        console.error('Error fetching post baggage:', error);
      }
    },
    async addPostBaggage(newItem: Omit<Baggage, 'id'>) {
      try {
        const response = await axiosInstance.post('/baggage_post', newItem);
        this.post_baggage.push(response.data); // Assuming response.data is the newly added item
      } catch (error) {
        console.error('Error adding post baggage:', error);
        throw error; // Throw the error to handle it in the component
      }
    },
    async deletePostBaggage(itemId: number) {
      try {
        await axiosInstance.delete(`/baggage_delete/${itemId}`);
        this.post_baggage = this.post_baggage.filter(item => item.id !== itemId);
      } catch (error) {
        console.error('Error deleting post baggage:', error);
        throw error; // Throw the error to handle it in the component
      }
    },
    async getCurrentLocation(): Promise<{ longitude: number; latitude: number }> {
      return new Promise((resolve, reject) => {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const { longitude, latitude } = position.coords;
              resolve({ longitude, latitude });
            },
            (error) => {
              console.error('Error getting location:', error);
              reject(error);
            }
          );
        } else {
          const error = new Error('Geolocation is not supported by this browser.');
          console.error(error.message);
          reject(error);
        }
      });
    },
    async updateBaggageStatus(delivery_status_id: number, baggage_id: number) {
      try {
        const response = await axiosInstance.put(`/baggage_update/${baggage_id}`, {
          delivery_status_id
        });
        this.responseMessage = response.data.message;
      } catch (error) {
        console.error('Error updating baggage status:', error);
        throw error; // Throw the error to handle it in the component
      }
    }
  }
});
