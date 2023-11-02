using API.Data;
using API.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;

[ApiController]
[Route("user")]
public class UserController : ControllerBase
{
    private readonly AppDbContext _dbContext;

    public UserController(AppDbContext dbContext)
    {
        _dbContext = dbContext;
    }

    [HttpPost("login")]
    public async Task<IActionResult> LoginUser([FromBody] UserModel loginModel)
    {
        var user = await _dbContext.users
            .FirstOrDefaultAsync(u => u.email == loginModel.email && u.password == loginModel.password);

        if (user == null)
            return Unauthorized(new { Success = false, Message = "Invalid email or password" });

        // Return id and name along with the success message
        return Ok(new
        {
            Success = true,
            Message = "Login successful",
            login_id = user.id,
            login_name = user.name
        });
    }


    [HttpPost("register")]
    public async Task<IActionResult> RegisterUser([FromBody] UserModel registerModel)
    {
        if (ModelState.IsValid)
        {
            // Validate email format, password strength, etc.

            var user = new UserModel
            {
                name = registerModel.name,
                email = registerModel.email,
                password = registerModel.password,
                id = registerModel.id,
                user_type = registerModel.user_type,
                phone =registerModel.phone
            };

            _dbContext.users.Add(user);
            await _dbContext.SaveChangesAsync();

            return Ok(new { Success = true, Message = "Partner registered successfully" });
        }

        return BadRequest(new { Success = false, Errors = ModelState.Values.SelectMany(v => v.Errors) });
    }

    [HttpDelete("delete/{userId}")]
    public async Task<IActionResult> DeleteUser(int userId)
    {
        var existingUser = await _dbContext.users.FindAsync(userId);

        if (existingUser == null)
        {
            return NotFound(new { Success = false, Message = "Partner not found" });
        }

        _dbContext.users.Remove(existingUser);

        try
        {
            await _dbContext.SaveChangesAsync();
            return Ok(new { Success = true, Message = "Partner deleted successfully" });
        }
        catch (DbUpdateException ex)
        {
            // Log the exception
            return StatusCode(500, new { Success = false, Message = "An error occurred while deleting the partner." });
        }
    }
}
