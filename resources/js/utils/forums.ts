export const formatDate = (date: string): string => {
    const postDate = new Date(date);
    const day = postDate.getDate();
    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];
    const month = monthNames[postDate.getMonth()];
    const year = postDate.getFullYear().toString().slice(-2);

    return `${day} ${month}, ${year}`;
};

export const timeAgo = (date: string): string => {
    const postDate = new Date(date);
    const now = new Date();
    const diffInMs = now.getTime() - postDate.getTime();
    const diffInHours = diffInMs / (1000 * 60 * 60);

    if (diffInHours < 24) {
        return `${Math.floor(diffInHours)} hours ago`;
    }

    return formatDate(date);
};

export const truncateContent = (content: string, wordLimit: number): string => {
    const words = content.split(' ');
    return words.slice(0, wordLimit).join(' ') + (words.length > wordLimit ? '...' : '');
};
