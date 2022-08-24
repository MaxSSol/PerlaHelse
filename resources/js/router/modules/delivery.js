import Layout from '@/layout';

const deliveryRoutes = {
  path: '/delivery',
  component: Layout,
  redirect: '/delivery/index',
  alwaysShow: true,
  meta: {
    title: 'delivery',
    icon: 'shopping',
    permission: ['view menu delivery'],
  },
  children: [
    {
      path: 'pricing',
      component: () => import('@/views/pricing/Pricing'),
      name: 'pricing',
      meta: {
        title: 'pricing',
      },
    },
  ],
};

export default deliveryRoutes;
