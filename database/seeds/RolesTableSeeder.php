<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
         \App\Roles::create([
            'role_name'          => "Dashboard",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-laptop",
            'role_no'   => 0,
        ]);
         \App\Roles::create([
            'role_name'          => "Dashboard",
            'link'       => "admin/dashboard",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 1,
            'main_role'   => 0,
            'icon'   => "fa fa-laptop",
            'role_no'   => 1,
        ]);


         \App\Roles::create([
            'role_name'          => "Geneology",
            'link'       => "#",
            'submenu_count'   => 3,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-tree",
            'role_no'   => 0,
        ]);
        
         \App\Roles::create([
            'role_name'          => "Binary Geneology",
            'link'       => "admin/genealogy",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 3,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 2,
        ]);

         \App\Roles::create([
            'role_name'          => "Sponsor Geneology",
            'link'       => "admin/sponsortree",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 3,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 3,
        ]);


         \App\Roles::create([
            'role_name'          => "Tree Geneology",
            'link'       => "admin/tree",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 3,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 4,
        ]);


      
        \App\Roles::create([
            'role_name'          => "Register",
            'link'       => "#",
            'submenu_count'   => 0,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "#",
            'role_no'   => 0,
        ]);
     

        \App\Roles::create([
            'role_name'          => "Register",
            'link'       => "admin/register",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 7,
            'main_role'   => 0,
            'icon'   => "fa fa-plus",
            'role_no'   => 5,
        ]);



          \App\Roles::create([
            'role_name'          => "Admin",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-plus",
            'role_no'   => 0,
        ]);
         
         \App\Roles::create([
            'role_name'          => "Admin Register",
            'link'       => "admin/adminregister",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 6,
        ]);

          \App\Roles::create([
            'role_name'          => "View All",
            'link'       => "admin/viewalladmin",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 9,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 7,
        ]);

          

            \App\Roles::create([
            'role_name'          => "E-wallet",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "#",
            'role_no'   => 0,
        ]);
         

          \App\Roles::create([
            'role_name'          => "E-wallet",
            'link'       => "admin/wallet",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 12,
            'main_role'   => 0,
            'icon'   => "fa fa-university",
            'role_no'   => 8,
        ]);

     \App\Roles::create([
            'role_name'    => "Fund credits",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "#",
            'role_no'   =>0,
        ]);

           \App\Roles::create([
            'role_name'          => "Fund credits",
            'link'       => "admin/fund-credits",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 14,
            'main_role'   => 0,
            'icon'   => "icon-credit-card",
            'role_no'   =>9,
        ]);


 
           \App\Roles::create([
            'role_name'          => "Emails",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-envelope",
            'role_no'   => 0,
        ]);


               \App\Roles::create([
            'role_name'          => "Emails",
            'link'       => "admin/inbox",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 16,
            'main_role'   => 1,
            'icon'   => "fa fa-envelope",
            'role_no'   => 10,
        ]);



           \App\Roles::create([
            'role_name'          => "Ticket Center",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "#",
            'role_no'   => 0,
        ]);

            \App\Roles::create([
            'role_name'          => "Ticket Center",
            'link'       => "admin/helpdesk/tickets-dashboard",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 18,
            'main_role'   => 0,
            'icon'   => "fa fa-ticket",
            'role_no'   => 11,
        ]);


         \App\Roles::create([
            'role_name'          => "Tools",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "fa fa-wrench",
            'role_no'   => 0,
        ]);



           \App\Roles::create([
            'role_name'          => "Documents",
            'link'       => "admin/documentupload",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 20,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 12,
        ]);


           \App\Roles::create([
            'role_name'          => "Site Management",
            'link'       => "admin/sitedown_management",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 20,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 13,
        ]);

            \App\Roles::create([
            'role_name'          => "Voucher",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   => 0,
            'main_role'   => 1,
            'icon'   => "icon-file-text",
            'role_no'   => 0,
        ]);

          \App\Roles::create([
            'role_name'          => "Voucher List",
            'link'       => "admin/voucherlist",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 23,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 14,
        ]);

              \App\Roles::create([
            'role_name'          => "Voucher Request",
            'link'       => "admin/voucherrequest",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   => 23,
            'main_role'   => 0,
            'icon'   => "#",
            'role_no'   => 15,
        ]);


              \App\Roles::create([
            'role_name'          => "Profile",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   =>0,
            'main_role'   =>1,
            'icon'   => "#",
            'role_no'   => 0,
        ]);


            \App\Roles::create([
            'role_name'          => "Profile",
            'link'       => "admin/userprofile",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>26,
            'main_role'   =>0,
            'icon'   => "fa fa-users",
            'role_no'   => 16,
        ]);




           \App\Roles::create([
            'role_name'          => "Members",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   =>0,
            'main_role'   =>1,
            'icon'   => "fa fa-users",
            'role_no'   => 0,
        ]);


             \App\Roles::create([
            'role_name'          => "View all",
            'link'       => "admin/users",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>28,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 17,
        ]);

         \App\Roles::create([
            'role_name'          => "Edit Info",
            'link'       => "admin/users/password",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>28,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 18,
        ]);

           \App\Roles::create([
            'role_name'          => "System Settings",
            'link'       => "#",
            'submenu_count'   => 2,
            'is_root'   => "yes",
            'parent_id'   =>0,
            'main_role'   =>1,
            'icon'   => "fa fa-cogs",
            'role_no'   => 0,
        ]);

         \App\Roles::create([
            'role_name'          => "App Settings",
            'link'       => "admin/appsettings",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>31,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 19,
        ]);


         \App\Roles::create([
            'role_name'          => "System Templates",
            'link'       => "admin/welcomeemail",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>31,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 20,
        ]);

           \App\Roles::create([
            'role_name'          => "Network Settings",
            'link'       => "#",
            'submenu_count'   => 5,
            'is_root'   => "yes",
            'parent_id'   =>0,
            'main_role'   =>1,
            'icon'   => "fa fa-cogs",
            'role_no'   => 0,
        ]);

           \App\Roles::create([
            'role_name'          => "Commission Settings",
            'link'       => "admin/commissionsettings",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>34,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 21,
        ]);




           \App\Roles::create([
            'role_name'          => "Plan Settings",
            'link'       => "admin/plansettings",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>34,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 22,
        ]);


         \App\Roles::create([
            'role_name'          => "Bonus Settings",
            'link'       => "admin/bonus",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>34,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 23,
        ]);

             \App\Roles::create([
            'role_name'          => "Rank Settings",
            'link'       => "admin/ranksetting",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>34,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 24,
        ]);


         \App\Roles::create([
            'role_name'          => "Payment Gateway Settings",
            'link'       => "admin/paymentsettings",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>34,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 25,
        ]);

          \App\Roles::create([
            'role_name'          => "Payout",
            'link'       => "#",
            'submenu_count'   => 1,
            'is_root'   => "yes",
            'parent_id'   =>0,
            'main_role'   =>1,
            'icon'   => "#",
            'role_no'   => 0,
        ]);

           \App\Roles::create([
            'role_name'          => "Payout",
            'link'       => "admin/payoutrequest",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>40,
            'main_role'   =>0,
            'icon'   => "fa fa-money",
            'role_no'   => 26,
        ]);



             \App\Roles::create([
            'role_name'          => "Report",
            'link'       => "#",
            'submenu_count'   => 7,
            'is_root'   => "yes",
            'parent_id'   =>0,
            'main_role'   =>1,
            'icon'   => "fa fa-sticky-note",
            'role_no'   => 0,
        ]);



           \App\Roles::create([
            'role_name'          => "Joining Report",
            'link'       => "admin/joiningreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 27,
        ]);
          
            \App\Roles::create([
            'role_name'          => "Fund Credit Report",
            'link'       => "admin/fundcredit",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 28,
        ]);

          \App\Roles::create([
            'role_name'          => "Members Income Report",
            'link'       => "admin/incomereport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 29,
        ]);

         \App\Roles::create([
            'role_name'          => "Top Earnest Report",
            'link'       => "admin/topearners",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 30,
        ]);

           \App\Roles::create([
            'role_name'          => "Payout Report",
            'link'       => "admin/payoutreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 31,
        ]);

            \App\Roles::create([
            'role_name'          => "Sales Report",
            'link'       => "admin/salesreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 32,
        ]);


           \App\Roles::create([
            'role_name'          => "Top Enroller Report",
            'link'       => "admin/topenrollerreport",
            'submenu_count'   => 0,
            'is_root'   => "no",
            'parent_id'   =>42,
            'main_role'   =>0,
            'icon'   => "#",
            'role_no'   => 33,
        ]);





           
    }
}
