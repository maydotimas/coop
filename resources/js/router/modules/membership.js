/** When your routing table is too long, you can split it into small modules**/
import Layout from '@/layout';

const membershipRoutes = {
  path: '/membership',
  component: Layout,
  redirect: '/membership',
  name: 'Membership',
  children: [
    {
      path: '',
      component: () => import('@/views/membership/user'),
      name: 'userMembershipPage',
      meta: { title: 'membershipApplication', icon: 'user', permissions: ['user membership'] },
    },
    {
      path: 'details',
      component: () => import('@/views/membership/view'),
      name: 'membershipDetailsPage',
      meta: { title: 'myMembershipApplication', icon: 'user', permissions: ['manage membership', 'user membership'] },
      hidden: true,
    },
    {
      path: 'review/:id(\\d+)',
      component: () => import('@/views/membership/view'),
      name: 'membershipReviewPage',
      meta: { title: 'membershipApplication', icon: 'user', permissions: ['manage membership'] },
      hidden: true,
    },
    {
      path: 'create',
      component: () => import('@/views/membership/CreateMembership'),
      name: 'createMembershipPage',
      meta: { title: 'addMembershipApplication', noCache: true, permissions: ['user membership'] },
      hidden: true,
    },
  ],
};

export default membershipRoutes;
