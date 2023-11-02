using Microsoft.EntityFrameworkCore;
using API.Models;

namespace API.Data
{
    public class AppDbContext : DbContext
    {
        public AppDbContext(DbContextOptions<AppDbContext> options) : base(options)
        {
        }

        public DbSet<EventModel> events { get; set; }
        public DbSet<UserModel> users { get; set; }
        public DbSet<OrderModel> orders { get; set; }

        protected override void OnModelCreating(ModelBuilder modelBuilder)
        {
            // Specify the primary key for EventModel
            modelBuilder.Entity<EventModel>().HasKey(e => e.id);

            base.OnModelCreating(modelBuilder);
        }

    }
}
