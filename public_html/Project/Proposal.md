# Project Name: Simple Bank
## Project Summary: This project will create a bank simulation for users. They'll be able to have various accounts, do standard bank functions like deposit, withdraw, internal (user's accounts)/external(other user's account) transfers, and creating/closing accounts.
## Github Link: (Prod Branch of Project Folder)
## Project Board Link: 
## Website Link: (Heroku Prod of Project folder)
## Your Name: Hassan Khalid

<!--
### Line item / Feature template (use this for each bullet point)
#### Don't delete this

- [ ] \(mm/dd/yyyy of completion) Feature Title (from the proposal bullet point, if it's a sub-point indent it properly)
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: (Direct link to the file or files in heroku prod for quick testing (even if it's a protected page))
    - Pull Requests
      - PR link #1 (repeat as necessary)
    - Screenshots
      - Screenshot #1 (paste the image so it uploads to github) (repeat as necessary)
        - Screenshot #1 description explaining what you're trying to show
### End Line item / Feature Template
--> 
### Proposal Checklist and Evidence

- Milestone 1

    - [x] \(10/11/2021 of completion) User will be able to register a new account
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/register.php
    - Pull Requests
      - PR link: https://github.com/hasskhalid/IT202-005/pull/8
    - Screenshots
      - Screenshot #1: <img width="1402" alt="Screen Shot 2021-11-08 at 1 50 58 PM" src="https://user-images.githubusercontent.com/54921634/140801080-6f4725fa-f082-406c-8caf-0659fc5d5d68.png">
        - Screenshot #1 Description: We created the register.php file in which users will be able to register a new account. By doing so, we also have checks to see that the user is inputting valid responses to each of the required inputs. For example, we will check if the email is valid if it has an '@' symbol inside of it, but only one. If there are more than one then the email will be invalid and the user will get a response back saying so. This is to ensure that the user is inputting the correct information needed to register their account.

     - [x] \(10/11/2021 of completion) User will be able to login to their account (given they enter the correct credentials)
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/login.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/8
    - Screenshots
      - Screenshot #1: <img width="860" alt="image" src="https://user-images.githubusercontent.com/54921634/140803340-7e43f060-fb79-41a5-b2ba-470a5f2bbf5a.png">
        - Screenshot #1 Description: Here, we are making a login.php file in which it will validate the information that the user had for their profile. This will ask for an email and password then it will check the database to see if it matches the necessary information. If something is wrong or invalid, the user will get an alert, letting them know that their credentials inputted was incorrect.

     - [x] \(10/11/2021 of completion) User will be able to logout
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/logout.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/8
    - Screenshots
      - Screenshot #1: <img width="1108" alt="image" src="https://user-images.githubusercontent.com/54921634/140815475-584cbc7a-0ac1-4d7c-a036-13d8c588219e.png">
        - Screenshot #1 Description: By creating the logout.php file, we can log out a user from their current visit by resetting the session. Once the session is reset, the user will get a flash message confirming that they indeed logged out successfully.

     - [x] \(10/27/2021 of completion) Basic security rules implemented
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/login.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/21
    - Screenshots
      - Screenshot #1: <img width="848" alt="image" src="https://user-images.githubusercontent.com/54921634/141032874-0d94ef25-8304-433d-b467-acfce7ab7bbb.png">
        - Screenshot #1 Description: For this feature, we made roles in which the user must be registered in order to view the Home page. If the user is not registered or logged in then they will receive a message saying they must be logged in to see the page. 

     - [x] \(10/27/2021 of completion) Basic Roles implemented
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/assign_roles.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/21
    - Screenshots
      - Screenshot #1: <img width="1069" alt="image" src="https://user-images.githubusercontent.com/54921634/140833485-6547f2ea-017c-4c56-bebc-a8d611242532.png">
        - Screenshot #1 Description: In order to create roles, we also had to create the admin role which can assign roles for any users that may register on the site. To do this, I manually assigned myself as the admin by inserting a new row in the Roles database. We also created an admin folder that contains the following 3 files: assign_roles.php, create_roles.php, and list_roles.php. 

    - [x] \(11/03/2021 of completion) Site should have basic styles/theme applied; everything should be styled
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/styles.css
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/20
    - Screenshots
      - Screenshot #1: <img width="1029" alt="image" src="https://user-images.githubusercontent.com/54921634/140835164-060eab80-5fc3-42bf-9101-a20ca9ef17ee.png">
        - Screenshot #1 Description: I created a style.css file under the Project folder in which I wrote some basic styling commands. I changed the background and font color of the body.
  
    - [x] \(10/11/2021 of completion) Any output messages/errors should be “user friendly”
  -  List of Evidence of Feature Completion
    - Status: Completed
    - Direct Link: https://hk362-prod.herokuapp.com/Project/login.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/9
    - Screenshots
      - Screenshot #1: <img width="835" alt="image" src="https://user-images.githubusercontent.com/54921634/140836904-60f9bd34-6ba7-4dad-b5ab-1934dc80ca3e.png">
        - Screenshot #1 Description: To add flash messages, we created flash.php which will enable the flash messages if the user incorrectly enters their credentials or if a new user is trying to register, but they inserted it in the wrong format. This will output friendly messages pertaining to what the error may be.

    - [x] \(10/11/2021 of completion) User will be able to see their profile
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: https://hk362-prod.herokuapp.com/Project/profile.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/8
    - Screenshots
      - Screenshot #1: <img width="1315" alt="image" src="https://user-images.githubusercontent.com/54921634/141033810-4318640d-89d3-42e5-a7e7-8f44ebd9dbd7.png">
        - Screenshot #1 Description: In this feature, we created profile.php in which the user would be able to see their profile and credentials which includes username/email and the password. This page, as you can see is its own dedicated page to display the user's profile. It can only be accessed if the user is signed in.

    - [x] \(10/11/2021 of completion) User will be able to edit their profile
  -  List of Evidence of Feature Completion
    - Status: Pending (Completed, Partially working, Incomplete, Pending)
    - Direct Link: https://hk362-prod.herokuapp.com/Project/profile.php
    - Pull Requests
      - PR link #1: https://github.com/hasskhalid/IT202-005/pull/8
    - Screenshots
      - Screenshot #1: <img width="1315" alt="image" src="https://user-images.githubusercontent.com/54921634/141033810-4318640d-89d3-42e5-a7e7-8f44ebd9dbd7.png">
        - Screenshot #1 Description: Following the creation of the profile.php file which displays the user's profile. This page will also allow the user to edit their profile. For now, they can change the username or password and it will change it for them in the database. 


- Milestone 2

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - Create the Accounts table (2021-11-22)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

    [https://hk362-prod.herokuapp.com/Project/sql/006_create_accounts.sql](https://hk362-prod.herokuapp.com/Project/sql/006_create_accounts.sql)</p></td></tr><tr><td>PRs:<p>

    [https://github.com/hasskhalid/IT202-005/pull/43](https://github.com/hasskhalid/IT202-005/pull/43)</p></td></tr><tr><td><table><tr><td>F1 - (id, account_number [unique, always 12 characters], user_id, balance (default 0), account_type, created, modified)<tr><td>Status: completed</td></tr><tr><td><img width="100%" src="https://user-images.githubusercontent.com/54921634/144697422-9264a54f-8554-4eaf-94df-a647d7288c47.png"><p>Here is the table that was generated via the sql file for creating the accounts table.</td></tr></td></tr></table></td></tr></td></tr></table>

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - Project setup steps (2021-11-22)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

    [https://hk362-prod.herokuapp.com/Project/sql/007_insert_sys_account.sql](https://hk362-prod.herokuapp.com/Project/sql/007_insert_sys_account.sql)</p></td></tr><tr><td>PRs:<p>

    [https://github.com/hasskhalid/IT202-005/pull/43](https://github.com/hasskhalid/IT202-005/pull/43)</p></td></tr><tr><td><table><tr><td>F1 - Create these as initial setup scripts in the sql folder<tr><td>Status: completed</td></tr><tr><td><img width="100%" src="https://user-images.githubusercontent.com/54921634/144697540-b42e266b-5ef7-4b43-ae95-2ec226ead48b.png"><p>Here are the sql commands in which the Global account is created.</td></tr></td></tr></table></td></tr></td></tr></table>

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - Create the Transactions table (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

    [https://hk362-prod.herokuapp.com/Project/sql/008_create_transactions_table.sql](https://hk362-prod.herokuapp.com/Project/sql/008_create_transactions_table.sql)</p></td></tr><tr><td>PRs:<p>

    [https://github.com/hasskhalid/IT202-005/pull/44](https://github.com/hasskhalid/IT202-005/pull/44)</p></td></tr><tr><td><table><tr><td>F1 - Create the Transactions table<tr><td>Status: completed</td></tr><tr><td><img width="100%" src="https://user-images.githubusercontent.com/54921634/144697656-21d6786d-362a-4c4d-bfa4-3631ef3864e5.png"><p>This is the table that was created to record transactions that will be made.</td></tr></td></tr></table></td></tr></td></tr></table>

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - Dashboard page (2021-12-02)</td></tr><tr><td>Status: complete</td></tr><tr><td>Links:<p>

    [https://hk362-prod.herokuapp.com/Project/dashboard.php](https://hk362-prod.herokuapp.com/Project/dashboard.php)</p></td></tr><tr><td>PRs:<p>

    [https://github.com/hasskhalid/IT202-005/pull/45](https://github.com/hasskhalid/IT202-005/pull/45)</p></td></tr><tr><td><table><tr><td>F1 - Will have links for Create Account, My Accounts, Deposit, Withdraw Transfer, Profile<tr><td>Status: completed</td></tr><tr><td><img width="100%" src="https://user-images.githubusercontent.com/54921634/144697747-c69e99fd-8926-4f21-b8bb-7fcf6be5b026.png"><p>This page includes link for all the other bank features and will be the main screen for the bank.</td></tr></td></tr></table></td></tr></td></tr></table>

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - User will be able to create a checking account ()</td></tr><tr><td>Status: incomplete</td></tr><tr><td>Links:<p>

    [https://hk362-prod.herokuapp.com/Project/create_account.php](https://hk362-prod.herokuapp.com/Project/create_account.php)</p></td></tr><tr><td>PRs:<p>

    [https://github.com/hasskhalid/IT202-005/pull/46](https://github.com/hasskhalid/IT202-005/pull/46)</p></td></tr><tr><td><table><tr><td>F1 - System will generate a unique 12 digit account number<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - System will associate the account to the user<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Account type will be set as checking<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Will require a minimum deposit of $5 (from the world account)<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - User will see user-friendly error messages when appropriate<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - User will see user-friendly success message when account is created successfully<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr></td></tr></table>

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - User will be able to list their accounts (2021-12-03)</td></tr><tr><td>Status: incomplete</td></tr><tr><td>Links:</td></tr><tr><td>PRs:</td></tr><tr><td><table><tr><td>F1 - Show account number, account type and balance<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr></td></tr></table>

    <table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - User will be able to click an account for more information (a.ka. Transaction History page) (2021-12-03)</td></tr><tr><td>Status: incomplete</td></tr><tr><td>Links:</td></tr><tr><td>PRs:</td></tr><tr><td><table><tr><td>F1 - Show account number, account type, balance, opened/created date<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Show transaction history (from Transactions table)<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr></td></tr></table>

<table><tr><td>Milestone 2</td></tr><tr><td><table><tr><td>F1 - User will be able to deposit/withdraw from their account(s) (2021-12-03)</td></tr><tr><td>Status: incomplete</td></tr><tr><td>Links:</td></tr><tr><td>PRs:</td></tr><tr><td><table><tr><td>F1 - Form should have a dropdown of their accounts to pick from<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Form should have a field to enter a positive numeric value<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - For withdraw, add a check to make sure they can’t withdraw more money than the account has<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Form should allow the user to record a memo for the transaction<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Each transaction is recorded as a transaction pair in the Transaction table per the details below<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Show appropriate user-friendly error messages<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr><tr><td><table><tr><td>F1 - Show user-friendly success messages<tr><td>Status: incomplete</td></tr><tr><td><img width="100%" src=""><p></td></tr></td></tr></table></td></tr></td></tr></table>

- Milestone 3

    - [ ] \(mm/dd/yyyy of completion) User will be able to transfer between their accounts
  -  List of Evidence of Feature Completion
    - Status: 
    - Direct Link: 
    - Pull Requests
      - PR link #1:
    - Screenshots
      - Screenshot #1:
        - Screenshot #1 Description

     - [ ] \(mm/dd/yyyy of completion) Transaction History page
  -  List of Evidence of Feature Completion
    - Status: 
    - Direct Link: 
    - Pull Requests
      - PR link #1:
    - Screenshots
      - Screenshot #1:
        - Screenshot #1 Description:

     - [ ] \(mm/dd/yyyy of completion) User’s profile page should record/show First and Last name
  -  List of Evidence of Feature Completion
    - Status:
    - Direct Link: 
    - Pull Requests
      - PR link #1:
    - Screenshots
      - Screenshot #1:
        - Screenshot #1 Description:

     - [ ] \(mm/dd/yyyy of completion) User will be able to transfer funds to another user’s account
  -  List of Evidence of Feature Completion
    - Status: 
    - Direct Link: 
    - Pull Requests
      - PR link #1: 
    - Screenshots
      - Screenshot #1: 
        - Screenshot #1 Description: 

- Milestone 4
### Intructions
#### Don't delete this
1. Pick one project type
2. Create a proposal.md file in the root of your project directory of your GitHub repository
3. Copy the contents of the Google Doc into this readme file
4. Convert the list items to markdown checkboxes (apply any other markdown for organizational purposes)
5. Create a new Project Board on GitHub
   - Choose the Automated Kanban Board Template
   - For each major line item (or sub line item if applicable) create a GitHub issue
   - The title should be the line item text
   - The first comment should be the acceptance criteria (i.e., what you need to accomplish for it to be "complete")
   - Leave these in "to do" status until you start working on them
   - Assign each issue to your Project Board (the right-side panel)
   - Assign each issue to yourself (the right-side panel)
6. As you work
  1. As you work on features, create separate branches for the code in the style of Feature-ShortDescription (using the Milestone branch as the source)
  2. Add, commit, push the related file changes to this branch
  3. Add evidence to the PR (Feat to Milestone) conversation view comments showing the feature being implemented
     - Screenshot(s) of the site view (make sure they clearly show the feature)
     - Screenshot of the database data if applicable
     - Describe each screenshot to specify exactly what's being shown
     - A code snippet screenshot or reference via GitHub markdown may be used as an alternative for evidence that can't be captured on the screen
  4. Update the checklist of the proposal.md file for each feature this is completing (ideally should be 1 branch/pull request per feature, but some cases may have multiple)
    - Basically add an x to the checkbox markdown along with a date after
      - (i.e.,   - [x] (mm/dd/yy) ....) See Template above
    - Add the pull request link as a new indented line for each line item being completed
    - Attach any related issue items on the right-side panel
  5. Merge the Feature Branch into your Milestone branch (this should close the pull request and the attached issues)
    - Merge the Milestone branch into dev, then dev into prod as needed
    - Last two steps are mostly for getting it to prod for delivery of the assignment 
  7. If the attached issues don't close wait until the next step
  8. Merge the updated dev branch into your production branch via a pull request
  9. Close any related issues that didn't auto close
    - You can edit the dropdown on the issue or drag/drop it to the proper column on the project board