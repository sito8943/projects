## Data
- Users (id, name, password, projects, reviews, create_at, updated_at)
- Projects (id, user, name, description, image, tags, reviews, create_at, updated_at)
- Tags (id, name, create_at, updated_at)
- Reviews (id, user, project, comment, stars, create_at, updated_at)
- Reports (id, user, review, reason, create_at, updated_at)

## Functionality
- User can log in
- User can see details of a project from another user
- User can manage his/hers projects
- User can review (comment & stars) a project from another user
- User can report a review
- User can manage his/hers reviews
- User can manage his/hers reports
- Project belongs to a Tag
- Admin can manage user
- Admin can manage tags
- Admin can manage reviews
- Admin can manage all projects
- Admin can manage all reports