<x-layouts.chatapp>
    <div style="max-width: 100%; padding: 3rem 2rem;">
        <div style="text-align: center; margin-bottom: 3rem;">
            <h1 style="font-size: 2.25rem; font-weight: 700; color: #111827; margin-bottom: 1rem;">
                Welcome to Chaddity Chat
            </h1>
            <p style="font-size: 1.125rem; color: #4b5563;">
                Connect, communicate, and collaborate with your team in real-time.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
            <div style="background-color: #ffffff; border-radius: 0.5rem; padding: 2rem; border: 1px solid #e5e7eb;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">
                    Messages
                </h3>
                <p style="color: #4b5563; margin-bottom: 1.5rem;">
                    Send and receive messages instantly with your contacts.
                </p>
                <a href="#" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #dc2626; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 500; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#991b1b'" onmouseout="this.style.backgroundColor='#dc2626'">
                    View Messages
                </a>
            </div>

            <div style="background-color: #ffffff; border-radius: 0.5rem; padding: 2rem; border: 1px solid #e5e7eb;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">
                    Contacts
                </h3>
                <p style="color: #4b5563; margin-bottom: 1.5rem;">
                    Manage your contacts and organize your chat groups.
                </p>
                <a href="#" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #dc2626; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 500; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#991b1b'" onmouseout="this.style.backgroundColor='#dc2626'">
                    View Contacts
                </a>
            </div>

            <div style="background-color: #ffffff; border-radius: 0.5rem; padding: 2rem; border: 1px solid #e5e7eb;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #111827; margin-bottom: 1rem;">
                    Notifications
                </h3>
                <p style="color: #4b5563; margin-bottom: 1.5rem;">
                    Stay updated with your latest messages and events.
                </p>
                <a href="#" style="display: inline-block; padding: 0.75rem 1.5rem; background-color: #dc2626; color: white; border-radius: 0.375rem; text-decoration: none; font-weight: 500; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#991b1b'" onmouseout="this.style.backgroundColor='#dc2626'">
                    View All
                </a>
            </div>
        </div>

        <div style="background-color: #ffffff; border-radius: 0.5rem; padding: 2rem; border: 1px solid #e5e7eb;">
            <h2 style="font-size: 1.875rem; font-weight: 600; color: #111827; margin-bottom: 1.5rem;">
                Getting Started
            </h2>
            <p style="color: #4b5563; margin-bottom: 2rem;">
                Here are some tips to help you get started:
            </p>
            <ul style="list-style: none; padding: 0; display: flex; flex-direction: column; gap: 1rem;">
                <li style="display: flex; gap: 1rem; align-items: flex-start;">
                    <span style="color: #dc2626; font-weight: 700; flex-shrink: 0;">✓</span>
                    <span style="color: #374151;">Start a new conversation by clicking on Messages</span>
                </li>
                <li style="display: flex; gap: 1rem; align-items: flex-start;">
                    <span style="color: #dc2626; font-weight: 700; flex-shrink: 0;">✓</span>
                    <span style="color: #374151;">Add your friends and colleagues to your contacts</span>
                </li>
                <li style="display: flex; gap: 1rem; align-items: flex-start;">
                    <span style="color: #dc2626; font-weight: 700; flex-shrink: 0;">✓</span>
                    <span style="color: #374151;">Check notifications to stay updated</span>
                </li>
                <li style="display: flex; gap: 1rem; align-items: flex-start;">
                    <span style="color: #dc2626; font-weight: 700; flex-shrink: 0;">✓</span>
                    <span style="color: #374151;">Customize your settings in the profile menu</span>
                </li>
            </ul>
        </div>
    </div>
</x-layouts.chatapp>
